<template>
    <div class="panel panel-default instance-card">
        <div
            class="panel-image has-click"
            :class="{ 'not-cleared': !cleared, 'spoiler': card.spoilers && !cleared }"
            :style="'background-image: url(\'/img/cards/' + cardImage + '\')'"
            @click="isOpen = !isOpen"
        >
            <div class="instance-info text-light">
                {{ clearDate }}</span><br>
                <small v-if="cleared">{{ clearTimes }} Time<span v-if="clearTimes > 1">s</span></small>
            </div>
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
 * Clear-by-clears cards count as cleared when the first achievement in achievementData is cleared.
 * However, additional clear data is given from the subsequent achievements, such as how many times*
 * an instance has been cleared.
 */
export default {
    name: 'ClearByClearsCard',

    extends: ClearCard,

    data() {
        return {
            clearTimes: '',     // The clear times to display on the card.
            isOpen: false,      // Whehther or not the card's turn data is open.
            turnData: null      // Turn data to show on the card.
        }
    },

    methods: {
        /**
         * Sets the clear data for the card based on the card type.
         *
         * @return {Void}
         */
        setData() {
            this.card.achievementData.forEach(data => {
                const achievement = this.getAchievementById(data.id);

                if (achievement !== undefined) {
                    this.cleared = true;
                    this.clearDate = formatDate(achievement.Date * 1000);
                    this.clearTimes = data.times;
                }
            });

            this.setTurnData(this.card.turnData);
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
