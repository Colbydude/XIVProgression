<template>
    <div class="instances" v-if="status.Achievements.State !== -1">
        <template v-if="achievements != null && status.Achievements.State == 2">
            <filters />

            <h2 class="text-light">Main Scenario Quests</h2>
            <div class="row multi-columns-row">
                <div
                    class="col-md-6 col-lg-4"
                    v-for="questData in msq"
                    :key="typeof questData.quest === 'object' ? questData.quest[0] : questData.quest"
                >
                    <quest-card :quest-data="questData"></quest-card>
                </div>
            </div>

            <h2 class="text-light">Raids</h2>
            <div class="row multi-columns-row">
                <div
                    class="col-md-6 col-lg-4"
                    v-for="card in raids"
                    :key="card.name"
                >
                    <instance-card :card="card"></instance-card>
                </div>
            </div>

            <h2 class="text-light">Alliance Raids</h2>
            <div class="row multi-columns-row">
                <div
                    class="col-md-6 col-lg-4"
                    v-for="card in allianceRaids"
                    :key="card.name"
                >
                    <instance-card :card="card"></instance-card>
                </div>
            </div>

            <h2 class="text-light">Trials</h2>
            <div class="row multi-columns-row">
                <div
                    class="col-md-6 col-lg-4"
                    v-for="card in trials"
                    :key="card.name"
                >
                    <instance-card :card="card"></instance-card>
                </div>
            </div>
        </template>

        <div class="panel panel-default" v-else-if="status.Achievements.State === 7">
            <div class="panel-body text-center">
                <h2>Fetching achievement data...</h2>
                <div class="form-group preloader-wrapper">
                    <span class="fa fa-spinner fa-pulse fa-5x fa-fw"></span>
                    <span class="sr-only">Loading...</span>
                </div>
            </div>
        </div>

        <div class="panel panel-default" v-else-if="status.Achievements.State === 5">
            <div class="panel-body text-center">
                <p class="lead" style="margin-bottom: 0;">{{ stateMessage }}</p>
            </div>
        </div>
    </div>
</template>

<script>
import Filters from './Filters.vue';
import InstanceCard from './InstanceCard.vue';
import QuestCard from './QuestCard.vue';
import Quests from './../data/quests';
import Instances from './../data/instances';
import { stateMessages } from './../data/messages';
import { mapState } from 'vuex';

export default {
    name: 'InstanceList',

    components: {
        Filters,
        InstanceCard,
        QuestCard,
    },

    computed: {
        /**
         * List of alliance raids/24-man instances.
         *
         * @return {Array}
         */
        allianceRaids() {
            if (this.filters.expansion.length === 0) {
                return Instances['alliance'];
            }

            return Instances['alliance'].filter(instance => this.filters.expansion.includes(instance.expansion));
        },

        /**
         * List Main Scenario Quests.
         *
         * @return {Array}
         */
        msq() {
            if (this.filters.expansion.length === 0) {
                return Quests['msq'];
            }

            return Quests['msq'].filter(quest => this.filters.expansion.includes(quest.expansion));
        },

        /**
         * List raids/8-man instances.
         *
         * @return {Array}
         */
        raids() {
            if (this.filters.expansion.length === 0) {
                return Instances['raids'];
            }

            return Instances['raids'].filter(instance => this.filters.expansion.includes(instance.expansion));
        },

        /**
         * Message to display on different response states.
         *
         * @return {String}
         */
        stateMessage() {
            return stateMessages[this.status.Achievements.State];
        },

        /**
         * List of trial instances.
         *
         * @return {Array}
         */
        trials() {
            if (this.filters.expansion.length === 0) {
                return Instances['trials'];
            }

            return Instances['trials'].filter(instance => this.filters.expansion.includes(instance.expansion));
        },

        ...mapState(['achievements', 'filters', 'status'])
    }
};
</script>
