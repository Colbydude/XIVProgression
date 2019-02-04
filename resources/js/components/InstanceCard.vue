<template>
    <div class="panel panel-default instance-card">
        <template v-if="card.type == 'clear-by-clears'">
            <div class="panel-image" :class="{ 'not-cleared': !cleared }" :style="'background-image: url(\'/img/cards/' + card.image + '\')'">
                <div class="instance-info text-light">
                    {{ clearDate }}</span><br>
                    <small v-if="cleared">{{ clearTimes }} Time<span v-if="clearTimes > 1">s</span></small>
                </div>
                <span class="panel-title">{{ card.name }}</span>
            </div>
            <table class="table table-condensed table-striped" v-if="turnData !== null">
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
                        <td>{{ turn.name }}</td>
                        <td v-if="turn.id !== undefined">
                            <span v-if="turn.cleared">{{ turn.clearDate }}</span>
                            <span v-else>Not yet cleared.</span>
                        </td>
                        <td v-else>No corresponding achievement.</td>
                    </tr>
                </tbody>
            </table>
        </template>
        <template v-else-if="card.type == 'clear-by-turns'">
            <div class="panel-image" :class="{ 'not-cleared': !cleared }" :style="'background-image: url(\'/img/cards/' + card.image + '\')'">
                <div class="instance-info text-light"></div>
                <span class="panel-title">{{ card.name }}</span>
            </div>
            <table class="table table-condensed table-striped" v-if="turnData !== null">
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
                        <td>{{ turn.name }}</td>
                        <td v-if="turn.id !== undefined">
                            <span v-if="turn.cleared">{{ turn.clearDate }}</span>
                            <span v-else>Not yet cleared.</span>
                        </td>
                        <td v-else>No corresponding achievement.</td>
                    </tr>
                </tbody>
            </table>
        </template>
        <template v-else-if="card.type == 'single'">
            <div class="panel-image" :class="{ 'not-cleared': !cleared }" :style="'background-image: url(\'/img/cards/' + card.image + '\')'">
                <div class="instance-info text-light">
                    <span class="instance-clear-date">{{ clearDate }}</span>
                </div>
                <span class="panel-title">{{ card.name }}</span>
            </div>
        </template>
    </div>
</template>

<script>
    import { mapGetters } from 'vuex';

    export default {
        name: 'InstanceCard',

        props: {
            card: {
                type: Object,
                required: true
            }
        },

        mounted() {
            this.setData();
        },

        data () {
            return {
                cleared: false,     // Whether or not the card (instance) has been cleared.
                clearDate: '',      // The clear date to display on the card.
                clearTimes: '',     // The clear times to display on the card (only on clear-by-clears cards).
                turnData: null      // Turn data to show on the card.
            }
        },

        computed: mapGetters(['getAchievementById']),

        methods: {
            /**
             * Sets the clear data for the card based on the card type.
             *
             * @return {Void}
             */
            setData () {
                /**
                 * Clear-by-clears cards count as cleared when the first achievement in achievementData is cleared.
                 * However, additional clear data is given from the subsequent achievements, such as how many times*
                 * an instance has been cleared.
                 */
                if (this.card.type == 'clear-by-clears') {
                    this.card.achievementData.forEach(data => {
                        const achievement = this.getAchievementById(data.id);

                        if (achievement !== undefined) {
                            this.cleared = true;
                            this.clearDate = this.$time(achievement.Date * 1000).format('MMMM Do YYYY, h:mm a');
                            this.clearTimes = data.times;
                        }
                    });

                    this.setTurnData(this.card.turnData);
                }
                /**
                 * Clear-by-turns cards count as cleared when all the turns in the instance have been cleared.
                 */
                else if (this.card.type == 'clear-by-turns') {
                    this.setTurnData(this.card.turnData);

                    var turnClears = 0;

                    this.turnData.forEach(turn => {
                        if (turn.cleared) {
                            turnClears++;
                        }
                    });

                    this.cleared = turnClears == this.turnData.length;
                }
                /**
                 * Single cards count as cleared simply when the achievement is present.
                 */
                else if (this.card.type == 'single') {
                    const achievement = this.getAchievementById(this.card.achievement_id);

                    if (achievement !== undefined) {
                        this.cleared = true;
                        this.clearDate = this.$time(achievement.Date * 1000).format('MMMM Do YYYY, h:mm a');
                    }
                }
            },

            /**
             * Sets the clear data for the card's turn data.
             *
             * @param  {Object}  turnData
             * @return {Void}
             */
            setTurnData (turnData) {
                turnData.forEach(data => {
                    if (data.id === undefined) {
                        return;
                    }

                    var achievement = this.getAchievementById(data.id);

                    data.cleared = false;

                    if (achievement !== undefined) {
                        data.icon = achievement.Icon;
                        data.cleared = true;
                        data.clearDate = this.$time(achievement.Date * 1000).format('MMMM Do YYYY, h:mm a');
                    }
                });

                this.turnData = turnData;
            }
        }
    }
</script>
