<template>
    <div class="panel panel-default character-pane" id="character-data">
        <div class="panel-body" v-if="character !== null && status.Character.State == 2">
            <div class="row">
                <div class="col-md-4">
                    <p><img class="img-responsive hidden-xs" :src="character.Portrait" :alt="character.Name + '-' + character.Server" width="640" height="873"></p>
                    <a class="btn btn-info btn-block" :href="lodestoneUrl" target="_blank">View Lodestone Profile</a>
                </div>
                <div class="col-md-8">
                    <h1>
                        {{ character.Name }}<br>
                        <small>{{ character.Title.Name }}</small>
                    </h1>
                    <div class="row">
                        <div class="col-sm-6">
                            <h4><img class="role-icon" src="/img/icons/tank.png" alt="Tank Icon" width="32" height="32"> Tank</h4>
                            <ul class="character-jobs">
                                <job-list-item :class-job="character.ClassJobs['1_19']" />  <!-- PLD -->
                                <job-list-item :class-job="character.ClassJobs['3_21']" />  <!-- WAR -->
                                <job-list-item :class-job="character.ClassJobs['32_32']" /> <!-- DRK -->
                            </ul>
                            <h4><img class="role-icon" src="/img/icons/healer.png" alt="Healer Icon" width="32" height="32"> Healer</h4>
                            <ul class="character-jobs">
                                <job-list-item :class-job="character.ClassJobs['6_24']" />  <!-- WHM -->
                                <job-list-item :class-job="character.ClassJobs['26_28']" /> <!-- SCH -->
                                <job-list-item :class-job="character.ClassJobs['33_33']" /> <!-- AST -->
                            </ul>
                        </div>
                        <div class="col-sm-6">
                            <h4><img class="role-icon" src="/img/icons/melee-dps.png" alt="Melee DPS Icon" width="32" height="32"> Melee DPS</h4>
                            <ul class="character-jobs">
                                <job-list-item :class-job="character.ClassJobs['2_20']" />  <!-- MNK -->
                                <job-list-item :class-job="character.ClassJobs['4_22']" />  <!-- DRG -->
                                <job-list-item :class-job="character.ClassJobs['29_30']" /> <!-- NIN -->
                                <job-list-item :class-job="character.ClassJobs['34_34']" /> <!-- SAM -->
                            </ul>
                            <h4><img class="role-icon" src="/img/icons/physical-ranged-dps.png" alt="Physical Ranged DPS Icon" width="32" height="32"> Physical Ranged DPS</h4>
                            <ul class="character-jobs">
                                <job-list-item :class-job="character.ClassJobs['5_23']" />  <!-- BRD -->
                                <job-list-item :class-job="character.ClassJobs['31_31']" /> <!-- MCH -->
                            </ul>
                            <h4><img class="role-icon" src="/img/icons/magical-ranged-dps.png" alt="Magical Ranged DPS Icon" width="32" height="32"> Magical Ranged DPS</h4>
                            <ul class="character-jobs">
                                <job-list-item :class-job="character.ClassJobs['7_25']" />  <!-- BLM -->
                                <job-list-item :class-job="character.ClassJobs['26_27']" /> <!-- SMN -->
                                <job-list-item :class-job="character.ClassJobs['35_35']" /> <!-- RDM -->
                                <job-list-item :class-job="character.ClassJobs['36_36']" /> <!-- BLU -->
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="panel-body text-center" v-else-if="status.Character.State === 7">
            <h2>Fetching character data...</h2>
            <div class="form-group preloader-wrapper">
                <span class="fa fa-spinner fa-pulse fa-5x fa-fw"></span>
                <span class="sr-only">Loading...</span>
            </div>
        </div>

        <div class="panel-body text-center" v-else>
            <p class="lead" style="margin-bottom: 0;">{{ stateMessage }}</p>
        </div>
    </div>
</template>

<script>
    import { mapState } from 'vuex';

    export default {
        computed: {
            /**
             * Gets the character's (NA) Lodestone URL.
             *
             * @return {String}
             */
            lodestoneUrl() {
                return `https://na.finalfantasyxiv.com/lodestone/character/${this.character.ID}`;
            },

            /**
             * Message to display on different response states.
             *
             * @return {String}
             */
            stateMessage() {
                switch (this.status.Character.State) {
                    case 0:
                        return 'Content is not on XIVAPI and will not be added via this request. Try again later.';
                    case 1:
                        return 'Content does not exist on the XIVAPI and needs adding. It should take 2 minutes or less to add the content. Try again.';
                    case 2:
                        return 'OK';
                    case 3:
                        return 'Character could not be found on the Lodestone.';
                    case 4:
                        return 'Character has been blacklisted from the XIVAPI.';
                    case 5:
                        return 'Content is private on the Lodestone, ask the owner to make the content public and then try again!';

                    case 7:
                        return 'Fetching character data...';
                    case 8:
                        return 'Failure communicating with progression checker backend.';
                    case 9:
                        return 'Failure communicating with the XIVAPI.';
                }
            },

            ...mapState(['character', 'status'])
        }
    };
</script>
