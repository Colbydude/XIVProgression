<template>
    <div class="panel panel-default instance-card">
        <div
            class="panel-image"
            :class="{ 'not-cleared': !cleared, 'spoiler': card.spoilers && !cleared }"
            :style="'background-image: url(\'/img/cards/' + cardImage + '\')'"
        >
            <div class="instance-info text-light">
                <span class="instance-clear-date">{{ clearDate }}</span>
            </div>
            <span class="panel-title">{{ cardName }}</span>
        </div>
    </div>
</template>

<script>
import ClearCard from './ClearCard.vue';
import { formatDate } from '../../utils';

/**
 * Single cards count as cleared simply when the achievement is present.
 */
export default {
    name: 'SingleInstanceCard',

    extends: ClearCard,

    methods: {
        /**
         * Sets the clear data for the card based on the card type.
         *
         * @return {Void}
         */
        setData() {
            const achievement = this.getAchievementById(this.card.achievement_id);

            if (achievement != null) {
                this.cleared = true;
                this.clearDate = formatDate(achievement.Date * 1000);
            }
        }
    }
}
</script>
