<template>
  <v-navigation-drawer v-model="show" :right="true" temporary fixed >
    <v-list>
      <v-list-item >
        <v-list-item-action>
          <v-icon dark>
            mdi-palette
          </v-icon>
        </v-list-item-action>
        <v-list-item-content>
          Tema
        </v-list-item-content>
      </v-list-item>
    </v-list>
  </v-navigation-drawer>
</template>

<script>
    export default {
        name: "sidebar-right",
        props:['value'],
        data(){
            return {
              show: this.open
            }
        },
        computed:{
        },
        watch: {
            open: function(val) { // watch it
                this.show = val;
            },
            show: function(val) { // watch it
                this.open = val;
            }
        }
    }
</script>

<style scoped>

</style>
