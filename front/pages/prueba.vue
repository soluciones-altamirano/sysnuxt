<template>
  <div>
    <h1>Opciones</h1>

    <v-card
      class="mx-auto"
      max-width="500"
    >
      <v-sheet class="pa-4 gray lighten-2" color="">
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
          label="Case sensitive search" color="white"
        ></v-checkbox>

      </v-sheet>
      <hr>
      <v-card-text>

        <v-treeview :items="items"
          :search="search"
          :filter="filter"
          :open.sync="open"
          activatable
          item-key="name"
          open-on-click
        >
          <template v-slot:prepend="{ item }">
            <v-icon v-text="`${item.icono_l}`"></v-icon>
          </template>

        </v-treeview>

      </v-card-text>
    </v-card>

  </div>
</template>

<script>

    export default {
        middleware: 'auth',
        name: 'prueba',
        mounted(){
            this.consolaJs("Componente prueba montado")
        },
        created(){
            this.consolaJs("Componente prueba creado")
            this.getDatos();
        },
        data: () => ({
            open: [1, 2],
            search: null,
            caseSensitive: false,
            items: [],
        }),
        computed: {
            filter () {
                return this.caseSensitive
                    ? (item, search, textKey) => item[textKey].indexOf(search) > -1
                    : undefined
            },
        },
        watch: {
            loading (val) {
                val || this.getDatos()
            },
        },
        methods: {
            async getDatos () {

                this.consolaJs("método get datos prueba");

                try{

                    const res = await this.$axios.$get('api/options');
                    this.items = res.data;

                }catch (error) {

                    console.log(error)
                }


            }
        }
    }
</script>


<style scoped>

</style>
