<template>
    <div class="expansion-filters">
        <div class="row">
            <div class="col-xs-6 col-sm-3 col-sm-offset">
                <button class="btn btn-light btn-block">
                    <img class="img-responsive" src="/img/logos/a-realm-reborn.png" alt="A Realm Reborn" />
                </button>
            </div>
            <div class="col-xs-6 col-sm-3">
                <button class="btn btn-light btn-block">
                    <img class="img-responsive" src="/img/logos/heavensward.png" alt="Heavensward" />
                </button>
            </div>
            <div class="col-xs-6 col-sm-3">
                <button class="btn btn-light btn-block">
                    <img class="img-responsive" src="/img/logos/stormblood.png" alt="Stormblood" />
                </button>
            </div>
            <div class="col-xs-6 col-sm-3">
                <button class="btn btn-light btn-block">
                    <img class="img-responsive" src="/img/logos/shadowbringers.png" alt="Shadowbringers" />
                </button>
            </div>
        </div>
    </div>
</template>

<script>
    import { mapState } from 'vuex';

    export default {
        name: 'Filters',

        computed: mapState(['filters'])
    };
</script>
