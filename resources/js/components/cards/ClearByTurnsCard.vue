<template>
    <div class="panel panel-default instance-card">
        <div
            class="panel-image has-click"
            :class="{ 'not-cleared': !cleared, 'spoiler': card.spoilers && !cleared }"
            :style="'background-image: url(\'/img/cards/' + cardImage + '\')'"
            @click="isOpen = !isOpen"
        >
            <div class="instance-info text-light"></div>
            <span class="panel-title">{{ cardName }}</span>
            <span class="dropdown-indicator fa fa-fw fa-caret-down"></span>
        </div>
        <table class="table table-condensed table-striped" v-if="turnData !== null" v-show="isOpen">
            <thead>
                <tr>
                    <th>&nbsp;</th>
                    <th>Instance</th>
                    <th>Cleared</th>
                </tr>
            </thead>
            <tbody>
                <tr v-for="turn in turnData" :key="turn.name">
                    <td v-if="turn.icon !== undefined"><img :src="`https://xivapi.com/${turn.icon}`" :alt="turn.name" class="turn-icon" width="40" height="40"></td>
                    <td v-else>&nbsp;</td>
                    <td>{{ card.spoilers ? (cleared ? turn.name : '???') : turn.name }}</td>
                    <td v-if="turn.id !== undefined">
                        <span v-if="turn.cleared">{{ turn.clearDate }}</span>
                        <span v-else>Not yet cleared.</span>
                    </td>
                    <td v-else>No corresponding achievement.</td>
                </tr>
            </tbody>
        </table>
    </div>
</template>

<script>
import ClearCard from './ClearCard.vue';
import { formatDate } from '../../utils';

/**
 * Clear-by-turns cards count as cleared when all the turns in the instance have been cleared.
 * Ex. The Second Coil of Bahamut (Savage)
 */
export default {
    name: 'ClearByTurnsCard',

    extends: ClearCard,

    data() {
        return {
            isOpen: false,      // Whehther or not the card's turn data is open.
            turnData: null      // Turn data to show on the card.
        };
    },

    methods: {
        /**
         * Sets the clear data for the card based on the card type.
         *
         * @return {Void}
         */
        setData() {
            this.setTurnData(this.card.turnData);

            let turnClears = 0;

            this.turnData.forEach(turn => {
                if (turn.cleared) {
                    turnClears++;
                }
            });

            this.cleared = turnClears == this.turnData.length;
        },

        /**
         * Sets the clear data for the card's turn data.
         *
         * @param  {Object}  turnData
         * @return {Void}
         */
        setTurnData(turnData) {
            turnData.forEach(data => {
                if (data.id === undefined) {
                    return;
                }

                const achievement = this.getAchievementById(data.id);

                data.cleared = false;

                if (achievement !== undefined) {
                    data.icon = achievement.Icon;
                    data.cleared = true;
                    data.clearDate = formatDate(achievement.Date * 1000);
                }
            });

            this.turnData = turnData;
        }
    }
}
</script>
