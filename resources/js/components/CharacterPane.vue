<template>
    <div class="panel panel-default character-pane" id="character-data" v-if="character !== null && characterLoading == false">
        <div class="panel-body">
            <div class="row">
                <div class="col-md-4">
                    <p><img class="img-responsive hidden-xs" :src="character.portrait" :alt="character.name + '-' + character.server" width="640" height="873"></p>
                    <a class="btn btn-info btn-block" :href="character.url_lodestone" target="_blank">View Lodestone Profile</a>
                    <a class="btn btn-dark btn-block" :href="'http://xivdb.com/character/' + character.lodestone_id" target="_blank">View XIVDB Profile</a>
                </div>
                <div class="col-md-8">
                    <h1>
                        {{ character.name }}<br>
                        <small>{{ character.data.title }}</small>
                    </h1>
                    <div class="row">
                        <div class="col-sm-6">
                            <h4><img class="role-icon" src="/img/icons/tank.png" alt="Tank Icon" width="32" height="32"> Tank</h4>
                            <ul class="character-jobs">
                                <job-list-item :job="character.data.classjobs[1]" />
                                <job-list-item :job="character.data.classjobs[3]" />
                                <job-list-item :job="character.data.classjobs[32]" />
                            </ul>
                            <h4><img class="role-icon" src="/img/icons/healer.png" alt="Healer Icon" width="32" height="32"> Healer</h4>
                            <ul class="character-jobs">
                                <job-list-item :job="character.data.classjobs[6]" />
                                <job-list-item :job="character.data.classjobs[26]" job-name-override="Scholar" />
                                <job-list-item :job="character.data.classjobs[33]" />
                            </ul>
                        </div>
                        <div class="col-sm-6">
                            <h4><img class="role-icon" src="/img/icons/melee-dps.png" alt="Melee DPS Icon" width="32" height="32"> Melee DPS</h4>
                            <ul class="character-jobs">
                                <job-list-item :job="character.data.classjobs[2]" />
                                <job-list-item :job="character.data.classjobs[4]" />
                                <job-list-item :job="character.data.classjobs[29]" />
                                <job-list-item :job="character.data.classjobs[34]" />
                            </ul>
                            <h4><img class="role-icon" src="/img/icons/physical-ranged-dps.png" alt="Physical Ranged DPS Icon" width="32" height="32"> Physical Ranged DPS</h4>
                            <ul class="character-jobs">
                                <job-list-item :job="character.data.classjobs[5]" />
                                <job-list-item :job="character.data.classjobs[31]" />
                            </ul>
                            <h4><img class="role-icon" src="/img/icons/magical-ranged-dps.png" alt="Magical Ranged DPS Icon" width="32" height="32"> Magical Ranged DPS</h4>
                            <ul class="character-jobs">
                                <job-list-item :job="character.data.classjobs[7]" />
                                <job-list-item :job="character.data.classjobs[26]" />
                                <job-list-item :job="character.data.classjobs[35]" />
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    import { mapState } from 'vuex';

    export default {
        computed: mapState(['character', 'characterLoading'])
    }
</script>
