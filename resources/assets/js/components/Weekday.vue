<template>
    <div class="grid-item">
        <div class="weekday-title sticky-top">
            <div>
                <h3 class="daytitle" v-text="this.day"></h3>
                <span class="daydate" v-text="this.date"></span>
            </div>
        </div>

        <slot>
        </slot>

    </div>
</template>

<script>
export default {
  props: ["day", "date", "today"]
};
</script>

