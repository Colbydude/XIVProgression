<template>
    <div class="panel panel-default instance-card">
        <div class="panel-image" :class="{ 'not-cleared': !cleared }" :style="'background-image: url(\'/img/quests/' + questImage + '\')'">
            <div class="instance-info text-light">
                <span class="instance-clear-date">{{ clearDate }}</span>
            </div>
            <span class="panel-title">
                <img class="msq-icon" src="/img/icons/msq.png" alt="Main Story Quest"> {{ questName }} (Level {{ questData.level }})
            </span>
        </div>
    </div>
</template>

<script>
import { mapGetters } from 'vuex';
import { formatDate } from '../utils';

export default {
    name: 'QuestCard',

    props: {
        questData: {
            type: Object,
            required: true
        }
    },

    mounted() {
        this.setData();
    },

    data() {
        return {
            cleared: false,     // Whether or not the card (quest) has been cleared.
            clearDate: '',      // The clear date to display on the card.
            questImage: '',     // The quest image to display on the card.
            questName: ''       // The quest name to display on the card.
        }
    },

    computed: mapGetters(['getAchievementById']),

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
            if (typeof this.questData.quest === 'object') {
                this.questData.quest.some((questName, index) => {
                    return this.determineClear(
                        questName,
                        this.questData.image[index],
                        this.questData.achievement_id[index]
                    );
                });

                // None of the achievements were cleared, so list them all.
                if (!this.cleared) {
                    this.questName = this.questData.quest.join('/');
                    this.questImage = this.questData.image[0];
                }
            } else {
                this.determineClear(
                    this.questData.quest,
                    this.questData.image,
                    this.questData.achievement_id
                );
            }
        }
    }
}
</script>
