<template>
    <div class="panel panel-default instance-card">
        <div
            class="panel-image"
            :class="{ 'not-cleared': !cleared, 'spoiler': card.spoilers && !cleared }"
            :style="'background-image: url(\'/img/quests/' + cardImage + '\')'"
        >
            <div class="instance-info text-light">
                <span class="instance-clear-date">{{ clearDate }}</span>
            </div>
            <span class="panel-title">
                <img class="msq-icon" src="/img/icons/msq.png" alt="Main Scenario Quest"> {{ cardName }} (Level {{ card.level }})
            </span>
        </div>
    </div>
</template>

<script>
import ClearCard from './ClearCard.vue';
import { formatDate } from '../../utils';

export default {
    name: 'QuestCard',

    extends: ClearCard,

    computed: {
        cardImage() {
            return this.card.spoilers ? (this.cleared ? this.questImage : '???') : this.questImage;
        },

        cardName() {
            return this.card.spoilers ? (this.cleared ? this.questName : '???') : this.questName;
        },
    },

    data() {
        return {
            questImage: '',
            questName: ''
        };
    },

    mounted() {
        this.questImage = this.card.image;
        this.questName = this.card.name;

        this.setData();
    },

    methods: {
        determineClear(questName, questImage, achievementId) {
            const achievement = this.getAchievementById(achievementId);

            this.questImage = questImage;
            this.questName = questName;

            if (achievement != null) {
                this.cleared = true;
                this.clearDate = formatDate(achievement.Date * 1000);

                return true;
            }

            return false;
        },

        setData() {
            // It's possible that multiple quests/achievements can finish
            // a specific segment of the MSQ, so we compensate for that here.
            if (typeof this.card.quest === 'object') {
                this.card.quest.some((questName, index) => {
                    return this.determineClear(
                        questName,
                        this.card.image[index],
                        this.card.achievement_id[index]
                    );
                });

                // None of the achievements were cleared, so list them all.
                if (!this.cleared) {
                    this.questName = this.card.quest.join('/');
                    this.questImage = this.card.image[0];
                }
            } else {
                this.determineClear(
                    this.card.quest,
                    this.card.image,
                    this.card.achievement_id
                );
            }
        }
    }
}
</script>
