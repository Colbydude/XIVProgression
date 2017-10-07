<template>
    <div>
        <div v-if="achievements !== null && achievementsLoading !== false">
            <h2 class="text-light">8-Man Raids</h2>
            <div class="row multi-columns-row">
            </div>

            <h2 class="text-light">24-Man Raids</h2>
            <div class="row multi-columns-row">
            </div>

            <h2 class="text-light">Trials</h2>
            <div class="row multi-columns-row">
            </div>
        </div>
        <div v-if="achievementsLoading" class="text-center">
            <h1 class="text-light">Fetching achievement data...</h1>
            <div class="form-group preloader-wrapper text-light">
                <span class="fa fa-spinner fa-pulse fa-5x fa-fw"></span>
                <span class="sr-only">Loading...</span>
            </div>
        </div>
    </div>
</template>

<script>
    import { mapState } from 'vuex';

    export default {
        data () {
            return {
                achievements: null
            }
        },

        computed: mapState(['achievementsLoading'])
    }
</script>
