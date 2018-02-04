<template>
  <div class="panel panel-default period">
            <div class="panel-body">
                <h3 class="appointment-time">
                    {{ this.time }}<sup>e</sup> uur
                </h3>

                <slot>
                </slot>
            </div>
        </div>
</template>

<script>
export default {
    props: ['time'],
}
</script>

