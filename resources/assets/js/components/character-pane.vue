<template>
    <div class="panel panel-default" id="character-data" v-if="character !== null && characterLoading == false">
        <div class="panel-body">
            <div class="row">
                <div class="col-md-4 hidden-xs">
                    <img class="img-responsive" :src="character.portrait" :alt="character.name + '-' + character.server">
                </div>
                <div class="col-md-8">
                    <h1 style="margin-top: 0;">{{ character.name }}</h1>
                    <p><strong>Active Class:</strong> {{ character.data.active_class.progress.name }} [{{ character.data.active_class.progress.level }}]</p>
                    <a class="btn btn-info" :href="character.url_lodestone" target="_blank">View Lodestone Profile</a>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    import { mapGetters, mapState } from 'vuex';

    export default {
        computed: mapState(['character', 'characterLoading'])
    }
</script>
