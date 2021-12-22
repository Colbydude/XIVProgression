<script>
import { mapGetters } from 'vuex';

export default {
    name: 'InstanceCard',

    props: {
        card: {
            type: Object,
            required: true
        }
    },

    data() {
        return {
            cleared: false,     // Whether or not the card (instance) has been cleared.
            clearDate: '',      // The clear date to display on the card.
        };
    },

    computed: {
        cardImage() {
            return this.card.spoilers ? (this.cleared ? this.card.image : '???') : this.card.image;
        },

        cardName() {
            return this.card.spoilers ? (this.cleared ? this.card.name : '???') : this.card.name;
        },

        ...mapGetters(['getAchievementById']),
    },

    mounted() {
        this.setData();
    },

    methods: {
        /**
         * Sets the clear data for the card based on the card type.
         * Overwritten in extended components.
         *
         * @return {Void}
         */
        setData() {
            return;
        }
    }
}
</script>
