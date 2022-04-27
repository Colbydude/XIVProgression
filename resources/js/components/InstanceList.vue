<template>
    <div class="instances" v-if="status.Achievements.State !== -1">
        <template v-if="achievements != null && status.Achievements.State == 2">
            <filters />

            <h2 class="text-light">Main Scenario Quests</h2>
            <div class="row multi-columns-row">
                <div
                    class="col-sm-6 col-lg-4"
                    v-for="questData in msq"
                    :key="
                        typeof questData.quest === 'object' ? questData.quest[0] : questData.quest
                    "
                >
                    <quest-card :card="questData" />
                </div>
            </div>

            <h2 class="text-light">Raids</h2>
            <div class="row multi-columns-row">
                <div class="col-sm-6 col-lg-4" v-for="card in raids" :key="card.name">
                    <template v-if="card.type === 'clear-by-clears'">
                        <clear-by-clears-card :card="card" />
                    </template>
                    <template v-else-if="card.type === 'clear-by-turns'">
                        <clear-by-turns-card :card="card" />
                    </template>
                </div>
            </div>

            <h2 class="text-light">Alliance Raids</h2>
            <div class="row multi-columns-row">
                <div class="col-sm-6 col-lg-4" v-for="card in allianceRaids" :key="card.name">
                    <single-instance-card :card="card" />
                </div>
            </div>

            <h2 class="text-light">Trials</h2>
            <div class="row multi-columns-row">
                <div class="col-sm-6 col-lg-4" v-for="card in trials" :key="card.name">
                    <single-instance-card :card="card" />
                </div>
            </div>

            <h2 class="text-light">Ultimate Raids</h2>
            <div class="row multi-columns-row">
                <div class="col-sm-6 col-lg-4" v-for="card in ultimates" :key="card.name">
                    <single-instance-card :card="card" />
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
                <p class="lead" style="margin-bottom: 0">{{ stateMessage }}</p>
            </div>
        </div>
    </div>
</template>

<script>
import Filters from './Filters.vue';
import ClearByClearsCard from './cards/ClearByClearsCard.vue';
import ClearByTurnsCard from './cards/ClearByTurnsCard.vue';
import QuestCard from './cards/QuestCard.vue';
import SingleInstanceCard from './cards/SingleInstanceCard.vue';
import Quests from './../data/quests';
import Instances from './../data/instances';
import { stateMessages } from './../data/messages';
import { mapState } from 'vuex';

export default {
    name: 'InstanceList',

    components: {
        Filters,
        ClearByClearsCard,
        ClearByTurnsCard,
        SingleInstanceCard,
        QuestCard,
    },

    computed: {
        /**
         * List of alliance raids/24-man instances.
         *
         * @return {Array}
         */
        allianceRaids() {
            return this.getInstances('alliance');
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

            return Quests['msq'].filter((quest) =>
                this.filters.expansion.includes(quest.expansion)
            );
        },

        /**
         * List raids/8-man instances.
         *
         * @return {Array}
         */
        raids() {
            return this.getInstances('raids');
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
            return this.getInstances('trials');
        },

        /**
         * List of ultimate raid instances.
         *
         * @return {Array}
         */
        ultimates() {
            return this.getInstances('ultimates');
        },

        ...mapState(['achievements', 'filters', 'status']),
    },

    methods: {
        /**
         * Get a section of the Instances list, filtered by expansion.
         *
         * @param {string} expansion
         * @return {Array}
         */
        getInstances(expansion) {
            if (this.filters.expansion.length === 0) {
                return Instances[expansion];
            }

            return Instances[expansion].filter((instance) =>
                this.filters.expansion.includes(instance.expansion)
            );
        },
    },
};
</script>
