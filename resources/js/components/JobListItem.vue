<template>
    <li>
        <div class="job-icon"><img :src="`/img/classes/${name.replace(' ', '')}.png`" :alt="capitalized" width="64" height="64"></div>
        <div class="job-level">{{ classJob.Level }}</div>
        <div class="job-name">{{ capitalized }}</div>
    </li>
</template>

<script>
    import startCase from 'lodash/startCase';

    export default {
        name: 'JobListItem',

        props: {
            classJob: {
                type: Object,
                required: true
            }
        },

        computed: {
            /**
             * Return the name, but capitalized.
             *
             * @return {String}
             */
            capitalized () {
                return startCase(this.name);
            },

            /**
             * Return the proper class/job name depending on level.
             *
             * @return {String}
             */
            name () {
                let name = this.classJob.Job.Name;

                if (this.classJob.Level < 30 && this.classJob.Job.Name !== 'scholar') {
                    name = this.classJob.Class.Name;
                }

                return name;
            },
        }
    };
</script>
