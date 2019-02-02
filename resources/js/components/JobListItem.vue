<template>
    <li>
        <div class="job-icon"><img :src="'/img/classes/' + jobNameToLower + '.png'" :alt="jobName" width="64" height="64"></div>
        <div class="job-level">{{ jobLevel }}</div>
        <div class="job-name">{{ jobName }}</div>
    </li>
</template>

<script>
    export default {
        props: ['job', 'jobNameOverride'],

        computed: {
            jobName () {
                if (this.jobNameOverride !== undefined) {
                    return this.jobNameOverride;
                }

                return this.job.name;
            },

            jobNameToLower () {
                var name = this.job.name;

                if (this.jobNameOverride !== undefined) {
                    name = this.jobNameOverride;
                }

                return name.toLowerCase().replace(/ /i, '');
            },

            jobLevel () {
                if (this.job.level == 0 || (this.jobNameOverride == 'Scholar' && this.job.name == 'Arcanist')) {
                    return '-';
                }

                return this.job.level;
            }
        }
    }
</script>
