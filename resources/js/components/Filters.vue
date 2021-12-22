<template>
    <div class="expansion-filters mt-4">
        <div class="row">
            <div class="col-xs-6 col-sm-15">
                <button
                    @click="toggleFilter('A Realm Reborn')"
                    :class="[filters.expansion.includes('A Realm Reborn') ? 'btn-primary' : 'btn-light']"
                    class="btn btn-block mb-4"
                >
                    <img class="img-responsive" src="/img/logos/a-realm-reborn.png" alt="A Realm Reborn" />
                </button>
            </div>
            <div class="col-xs-6 col-sm-15">
                <button
                    @click="toggleFilter('Heavensward')"
                    :class="[filters.expansion.includes('Heavensward') ? 'btn-primary' : 'btn-light']"
                    class="btn btn-block mb-4"
                >
                    <img class="img-responsive" src="/img/logos/heavensward.png" alt="Heavensward" />
                </button>
            </div>
            <div class="col-xs-6 col-sm-15">
                <button
                    @click="toggleFilter('Stormblood')"
                    :class="[filters.expansion.includes('Stormblood') ? 'btn-primary' : 'btn-light']"
                    class="btn btn-block mb-4"
                >
                    <img class="img-responsive" src="/img/logos/stormblood.png" alt="Stormblood" />
                </button>
            </div>
            <div class="col-xs-6 col-sm-15">
                <button
                    @click="toggleFilter('Shadowbringers')"
                    :class="[filters.expansion.includes('Shadowbringers') ? 'btn-primary' : 'btn-light']"
                    class="btn btn-block mb-4"
                >
                    <img class="img-responsive" src="/img/logos/shadowbringers.png" alt="Shadowbringers" />
                </button>
            </div>
            <div class="col-xs-6 col-sm-15">
                <button
                    @click="toggleFilter('Endwalker')"
                    :class="[filters.expansion.includes('Endwalker') ? 'btn-primary' : 'btn-light']"
                    class=" btn btn-block mb-4"
                >
                    <img class="img-responsive" src="/img/logos/endwalker.png" alt="Endwalker" />
                </button>
            </div>
        </div>
    </div>
</template>

<script>
import { mapMutations, mapState } from 'vuex';

export default {
    name: 'Filters',

    computed: mapState(['filters']),

    methods: {
        /**
         * Toggles the given filter.
         *
         * @param  {String}  filter
         * @return {Void}
         */
        toggleFilter(filter) {
            this.toggleExpansionFilter(filter);
        },

        ...mapMutations(['toggleExpansionFilter'])
    }
};
</script>
