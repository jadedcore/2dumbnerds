class HydraTree {
	/**
	 * An array of tree data that should be ordered by lft=> ASC
	 * _treeData = [];
	 *
	 * An array of leaf data indexed by id. This might be the same data as the treeData array if the leaf data is
	 * contained inside the treeData.
	 * _leaves = [];
	 *
	 * The index that references the leaves array. If this is the same as the treeData it would just be 'id'
	 * _leafIndex = 'id';
	 *
	 * Leaf active state can be defined by a provided array key. This will default to is_active but you can use
	 * the set activeIndex() method.
	 * _activeIndex = 'is_active'
	 *
	 * Default tree container ID. Can be changed with set treeContainerID()
	 * _treeContainerID = '#hydraTreeContainer';
	 *
	 * Deafult search container ID. Can be changed with set searchContainerID()
	 * _searchContainerID = '#hydraTreeSearch';
	 */

	constructor(options) {
		var self = this;

		if (options.treeData !== undefined) {
			this._treeData = options.treeData;
			this._leaves = options.treeData;
		} else {
			this._treeData = [];
			this._leaves = [];
		}

		if (options.leaves !== undefined) {
			this._leaves = options.leaves;
		}

		if (options.leafIndex !== undefined) {
			this._leafIndex = options.leafIndex;
		} else {
			this._leafIndex = 'id';
		}

		if (options.activeIndex !== undefined) {
			this._activeIndex = options.activeIndex;
		} else {
			this._activeIndex = 'is_active';
		}

		if (options.treeContainerID !== undefined) {
			this._treeContainerID = options.treeContainerID;
		} else {
			this._treeContainerID = '#hydraTreeContainer';
		}

		if (options.searchContainerID !== undefined) {
			this._searchContainerID = options.searchContainerID;
		} else {
			this._searchContainerID = '#hydraTreeSearch';
		}

		$(this._treeContainerID).on('click', '.expandList', function() {
			self.expandParent(self.getLeafElement($(this).data('leaf-id')));
		});

		$(this._treeContainerID).on('click', '.collapseList', function() {
			self.collapseParent(self.getLeafElement($(this).data('leaf-id')));
		});

		$(this._treeContainerID).on('click', '.leafName', function() {
			self._currentLeafData = self.getLeafInfo($(this).data('leaf-id'));
			self._currentNodeData = self.getNodeInfo($(this).data('leaf-id'));
			$(self).trigger("currentData:new");
		});

		$(this._searchContainerID).on('click', '.hydraSearchOptions', function() {
			self.jumpToLeaf($(this).data('leaf-id'));
		});
	}

	get leaves() {
		return this._leaves;
	}

	get treeData() {
		return this._treeData;
	}

	get leafIndex() {
		return this._leafIndex;
	}

	get activeIndex() {
		return this._activeIndex;
	}

	get treeContainerID() {
		return this._treeContainerID;
	}

	get searchContainerID() {
		return this._searchContainerID;
	}

	get currentLeafData() {
		return this._currentLeafData;
	}

	get currentNodeData() {
		return this._currentNodeData;
	}

	set treeData(treeData) {
		this._treeData = treeData;
	}

	set leaves(leaves) {
		this._leaves = leaves;
	}

	set leafIndex(index) {
		this._leafIndex = index;
	}

	set activeIndex(index) {
		this._activeIndex = index;
	}

	set treeContainerID(containerID) {
		var self = this;
		this._treeContainerID = '#' + containerID;

		$(this._treeContainerID).on('click', '.expandList', function() {
			self.expandParent(self.getLeafElement($(this).data('leaf-id')));
		});

		$(this._treeContainerID).on('click', '.collapseList', function() {
			self.collapseParent(self.getLeafElement($(this).data('leaf-id')));
		});
	}

	set searchContainerID(containerID) {
		var self = this;
		this._searchContainerID = '#' + containerID;
		$(this._searchContainerID).on('click', '.hydraSearchOptions', function() {
			self.jumpToLeaf($(this).data('leaf-id'));
		});
	}

	/**
	 * Draw the initial tree into the DOM
	 */
	drawTree() {
		var currentParentID = -1;
		var parentIDs = [];
		var firstRun = true;

		this._treeData.forEach(function(leaf, index) {
			var leafID = leaf.id;
			var parentID  = leaf.parent_id;
			var listElement = '';
			var listItem = '';
			var list = '';

			// If the parentID is null then it is the root node.
			if (parentID === null || parentID === 'null') {
				parentID = 0;
			}

			// New Parent
			if (parentID != currentParentID) {
				// parentID is not already in the array of parentIDs
				if ($.inArray(parentID, parentIDs) === -1) {
					parentIDs.push(parentID);
					// parentID is a root node
					if (parentID === 0) {
						list = $(document.createElement('div')).prop({
							'class': 'list'
						}).attr({
							'data-parent-id': parentID
						});
					} else { // parentID is not a root node
						list = $(document.createElement('div')).prop({
							'class': 'list hidden'
						}).attr({
							'data-parent-id': parentID
						});
					}
					// firstRun attach list to container. After that all lists are attached to an existing list
					if (firstRun) {
						$(this._treeContainerID).append(list);
						firstRun = false;
					} else {
						if (parentIDs.length > 1) {
							listElement = this.getParentListElement(parentIDs[parentIDs.length - 2]);
						} else {
							listElement = this.getParentListElement(0);
						}
						$(listElement).append(list);
					}
				} else { // parent ID is in the array of parentIDs
					while (parentIDs.length != 0) {
						var tempID = parentIDs.pop();
						if (tempID == parentID) {
							parentIDs.push(parentID);
							break;
						}
					}
				}
			}
			currentParentID = parentID;
			listItem = this.drawLeaf(leaf);
			listElement = this.getParentListElement(parentID);
			$(listElement).append(listItem);
		}, this);
	}

	/**
	 * Draw each individual leaf of the tree
	 *
	 * @param array leaf - The leaf data for the leaf to draw
	 * @return - Element to be added to the DOM
	 */
	drawLeaf(leaf) {
		var leafID = leaf.id;
		var leafTargetID = leaf[this._leafIndex];
		var isActive = this._leaves[leafTargetID][this._activeIndex];

		var listItem = $(document.createElement('div')).prop({
			'class': 'listItem'
		}).attr({
			'data-leaf-id': leafID
		}).html('_ ');

		var listName = $(document.createElement('a')).prop({
			'class': 'leafName'
		}).attr({
			'href': '#',
			'data-leaf-id': leafTargetID
		}).html(this._leaves[leafTargetID]['name']);

		if (!isActive) {
			listName.addClass('inactive');
		}

		listItem.append(listName);

		if (leaf.rght - leaf.lft > 1) {
			var listLink = $(document.createElement('a')).prop({
				'class': 'expandList'
			}).attr({
				'href': '#',
				'data-leaf-id': leafID
			}).html('Expand');

			listItem.append(' - ');
			listItem.append(listLink);
		}
		return listItem;
	}

	expandAll() {
		$('.list').removeClass('hidden');
		$('.expandList').html('Collapse');
		$('.expandList').addClass('collapseList');
		$('.expandList').removeClass('expandList');
	}

	collapseAll() {
		$('.list').addClass('hidden');
		$('.list[data-parent-id="0"]').removeClass('hidden');
		$('.collapseList').html('Expand');
		$('.collapseList').addClass('expandList');
		$('.collapseList').removeClass('collapseList');
	}

	expandParent(selectedLeaf) {
		var leafID = parseInt($(selectedLeaf).data('leaf-id'));
		var selectedLink = ".expandList[data-leaf-id='" + leafID + "']";

		$(selectedLink).html('Collapse');
		$(selectedLink).addClass('collapseList');
		$(selectedLink).removeClass('expandList');
		$(selectedLeaf.nextElementSibling).removeClass('hidden');
	}

	expandStructure(selectedLeaf) {
		var root = false;
		var testNode = selectedLeaf;
		while (root === false) {
			if ($(testNode.parentNode).data('parent-id') != 0) {
				var changeNodes = $(testNode.parentNode.previousSibling).children('.expandList');
				$(changeNodes).html('Collapse');
				$(changeNodes).addClass('collapseList');
				$(changeNodes).removeClass('expandList');
				testNode = testNode.parentNode.previousSibling;
			} else {
				root = true;
			}
		}

		$(selectedLeaf).parentsUntil(this._treeContainerID, '.list').removeClass('hidden');
	}

	collapseParent(selectedLeaf) {
		var leafID = parseInt($(selectedLeaf).data('leaf-id'));
		var selectedLink = ".collapseList[data-leaf-id='" + leafID + "']";

		$(selectedLink).html('Expand');
		$(selectedLink).addClass('expandList');
		$(selectedLink).removeClass('collapseList');
		$(selectedLeaf.nextElementSibling).addClass('hidden');
	}

	/**
	 * Get the data about a specific leaf.
	 *
	 * @param int leafID - The ID of the leaf whose data needs to be retrieved
	 * @return json Object - leaf Data
	 */
	getLeafInfo(leafID) {
		return this.leaves[leafID];
	}

	/**
	 * Get the tree node data for a leaf indicated by the leaf ID
	 *
	 * @param int leafID - The ID of the leaf whose tree node data needs to be retrieved
	 * @return mixed - array of node data or null
	 */
	getNodeInfo(leafID) {
		for (var index = 0; index < this._treeData.length; index++) {
			if (this._treeData[index][this._leafIndex] == leafID) {
				return this._treeData[index];
			}
		}
		return null;
	}

	/**
	 * Get the parent list element from the DOM for a given parent ID
	 *
	 * @param int parentID - The parentID of the DOM element being searched for
	 * @return - DOM element
	 */
	getParentListElement(parentID) {
		var selector = ".list[data-parent-id='" + parentID + "']";
		var listElement = [];
		$(selector).each(function(){
			listElement = this;
			return false;
		});
		return listElement;
	}

	/**
	 * Get the DOM element for the specified leaf ID
	 *
	 * @param int leafID - The leaf ID of the DOM element being searched for
	 * @return - DOM element
	 */
	getLeafElement(leafID) {
		var selector = ".listItem[data-leaf-id='" + leafID + "']";
		var leafElement = [];
		$(selector).each(function(){
			leafElement = this;
			return false;
		});
		return leafElement;
	}

	/**
	 * Get leaf name of the leaf with the specified ID
	 *
	 * @param int leafID - The ID of the leaf whose name is requested
	 * @return string - The leaf name
	 */
	getLeafName(leafID) {
		var leafElement = this.getLeafElement(leafID);
		return $(leafElement).children('.leafName').text().trim();
	}

	/**
	 * Get the path to the root node of any leaf by the specified ID
	 *
	 * @param int leafID - The ID of the leaf whose path to root is requested
	 * @return array - array of parents until the root node
	 */
	getLeafPath(leafID) {
		var self = this;
		var targetLeaf = this.getLeafElement(leafID);
		var path = [];

		$(targetLeaf).parentsUntil(this._treeContainerID, '.list').each(function() {
			var parentID = $(this).data('parent-id');
			if (isNaN(parentID) || parentID < 1) {
				return;
			}
			path.push(self.getLeafName(parentID));
		});
		return path.reverse();
	}

	/**
	 * String search of all leaves present in the tree
	 *
	 * @param string searchString - the value being searched for
	 * @return void
	 */
	searchLeaves(searchString) {
		if (searchString === undefined || searchString === '') {
			$(this._searchContainerID).empty();
			return;
		}

		var searchContainer = $(document.createElement('div'));
		var self = this;
		var count = 0;
		searchString = searchString.toLowerCase();

		$('.listItem').each(function() {
			var leafID = parseInt($(this).data('leaf-id'));
			var originalLeafName = self.getLeafName(leafID);
			var leafName = originalLeafName.trim().toLowerCase();
			if (leafName.indexOf(searchString) > -1) {
				var container = $(document.createElement('div'));
				var path = self.getLeafPath(leafID);
				for (var index = 0; index < path.length; index++) {
					container.append( document.createTextNode(path[index]) );
					container.append('<strong> / </strong>');
				}
				var link = $(document.createElement('a')).prop({
					'class': 'hydraSearchOptions',
					'href': '#'
				}).attr({
					'data-leaf-id': leafID
				}).html(
					originalLeafName
				);
				container.append(link);
				searchContainer.append(container);
				count++;
			}
		});
		if (count === 0) {
			var div = $(document.createElement('div')).prop({
				'class': 'alert'
			}).html('None');
			searchContainer.append(div);
		}
		$(this._searchContainerID).html(searchContainer);
	}

	/**
	 * Jump right to selecting and displaying the options for any leaf present in the tree
	 *
	 * @param int leafID - The ID of the leaf you wish to jump to
	 * @return void
	 */
	jumpToLeaf(leafID) {
		this.expandStructure(this.getLeafElement(leafID));
	}
}
