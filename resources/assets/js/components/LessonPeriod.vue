<template>
  <div class="panel panel-default">
            <div class="panel-body">
                <h3 class="appointment-time">{{ this.time }}<sup>e</sup> uur</h3>
                
                <p class="appointment-body">
                    Beschikbaar
                </p>
                
                <a href="#">Inplannen</a>

            </div>
        </div>
</template>

<script>
export default {

    props: ['time'],
  
}
</script>

