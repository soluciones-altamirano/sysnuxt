<template>

  <div>

    <v-sheet class="pa-2 gray lighten-2" color="">
      <v-text-field v-model="search"
                    label="Buscar en opciones..."
                    dark
                    flat
                    solo-inverted
                    hide-details
                    clearable
                    clear-icon="mdi-close-circle-outline"
                    onautocomplete="off"
      ></v-text-field>

      <v-checkbox v-model="caseSensitive"
                  dark
                  hide-details
                  label="Distingue mayúsculas y minúsculas" color="white"
      ></v-checkbox>

    </v-sheet>

    <hr>

    <!--      <v-list>-->
    <!--        <v-list-item v-for="(item, i) in items" :key="i" :to="item.to" router exact>-->
    <!--          <v-list-item-action>-->
    <!--            <v-icon>{{ item.icon }}</v-icon>-->
    <!--          </v-list-item-action>-->
    <!--          <v-list-item-content>-->
    <!--            <v-list-item-title v-text="item.title" />-->
    <!--          </v-list-item-content>-->
    <!--        </v-list-item>-->
    <!--      </v-list>-->

    <v-treeview :items="$store.state.menu.options"

                :search="search"
                :filter="filter"
                :open.sync="openMenu"
                activatable
                item-key="id"
                open-on-click
                :active.sync="active"
                return-object
    >
      <template v-slot:prepend="{ item }">
        <v-icon v-text="`${item.icono_l}`"></v-icon>
      </template>

    </v-treeview>
  </div>
</template>

<script>
    export default {
        name: "sidebar",
        data() {
            return{
                openMenu: [],
                search: null,
                caseSensitive: false,
                active: [],
            }
        },
        computed:{
            filter () {
                return this.caseSensitive
                    ? (item, search, textKey) => item[textKey].indexOf(search) > -1
                    : undefined
            },
            selected () {

                const item = this.active[0];

                return item;
            }

        },
        watch: {
            selected (item) {
                this.consolaJs('redirect to :',item.ruta);

                this.$router.replace(item.ruta);
            },
        }
    }
</script>

<style scoped>

</style>
