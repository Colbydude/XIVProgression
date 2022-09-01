/**
 * @typedef InstanceAchievementData
 * @property {number} id Achievement ID.
 * @property {number} times Number of clears needed to unlock this achievement.
 */

/**
 * @typedef InstanceTurnData
 * @property {number} id Achievement ID. Typically "Mapping the Realm" or individual instance clear achievement IDs.
 * @property {string} name The name of the individual achievement.
 */

/**
 * @typedef Instance
 * @property {string} name The name of the instance.
 * @property {'clear-by-clears','clear-by-turns','single'} type The type of criteria to unlock the achievement.
 * @property {'A Realm Reborn','Heavensward','Stormblood','Shadowbringers', 'Endwalker'} expansion The expansion this instance belongs to.
 * @property {number|undefined} achievement_id The Lodestone Achievement ID.
 * @property {string} image The instance card image.
 * @property {InstanceAchievementData[]|undefined} achievementData The achievement information for clear-by-clears instances.
 * @property {InstanceTurnData[]|undefined} turnData The information for each turn/instance of clear-by-clears or clear-by-turns raids.
 * @property {boolean|undefined} spoilers Whether or not the instance can be considered "spoilers" for current content.
 */

/**
 * @typedef Quest
 * @property {string|string[]} quest The name(s) of the quest(s).
 * @property {number} level The required level for the quest.
 * @property {'A Realm Reborn','Heavensward','Stormblood','Shadowbringers', 'Endwalker'} expansion The expansion this quest belongs to.
 * @property {number|numbers[]} achievement_id The achievement id(s) for the quest(s).
 * @property {string|string[]} image The image(s) for the quest card.
 * @property {boolean|undefined} spilers Whether or not the quest can be considered "spoilers" for current content.
 */
