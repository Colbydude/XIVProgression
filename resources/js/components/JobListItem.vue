<template>
    <li v-if="">
        <div class="job-icon"><img :src="`/img/classes/${name.replace(' ', '').toLowerCase()}.png`" :alt="name" width="64" height="64"></div>
        <div class="job-level">{{ classJob.Level }}</div>
        <div class="job-name text-capitalize">{{ name }}</div>
    </li>
</template>

<script>
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
         * Return the proper class/job name depending on level.
         *
         * @return {String}
         */
        name() {
            if (this.classJob.Job == null || this.classJob.Class == null) {
                return this.classJob.UnlockedState.Name;
            }

            if (this.classJob.Level < 30 && this.classJob.Job.Name !== 'scholar') {
                return this.classJob.Class.Name;
            }

            return this.classJob.Job.Name;
        },
    }
};
</script>
