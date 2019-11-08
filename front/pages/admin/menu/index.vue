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
                    item-key="id"
                    :active.sync="active"
                    return-object>

          <template v-slot:prepend="{ item }">
            <v-icon v-text="`${item.icono_l}`"></v-icon>
          </template>

          <template v-slot:label="{ item }">

              <span v-text="item.nombre"></span>


            <v-tooltip top>
              <template v-slot:activator="{ on }">
                <v-icon @click.prevent="create(item)" v-on="on" color="success"> mdi-plus </v-icon>
              </template>
              <span>Nueva Opcion</span>
            </v-tooltip>


            <v-tooltip top>
              <template v-slot:activator="{ on }">
                <v-icon @click.prevent="edit(item)" v-on="on" color="primary"> mdi-pencil </v-icon>
              </template>
              <span>Editar</span>
            </v-tooltip>


            <v-tooltip top>
              <template v-slot:activator="{ on }">
                <v-icon @click.prevent="confirmDestroy(item)" v-on="on" color="error"> mdi-delete </v-icon>
              </template>
              <span>Eliminar</span>
            </v-tooltip>



          </template>

        </v-treeview>

        <v-sheet>
          <v-btn fab color="success" x-small @click.prevent="create(null)">
            <v-icon>mdi-plus</v-icon>
          </v-btn>
        </v-sheet>
      </v-card-text>
    </v-card>


    <v-row justify="center">
      <v-dialog v-model="dialog" max-width="600px">
        <v-card>
          <v-card-title>
            <span class="headline">Nueva Opción {{para}}</span>
          </v-card-title>
          <v-card-text>
            <v-container>
              <v-row>
                <v-col cols="12" sm="12" md="12">
                  <v-text-field v-model="newItem.nombre" label="Nombre" required></v-text-field>
                </v-col>
                <v-col cols="12" sm="12" md="12">
                  <v-text-field v-model="newItem.ruta" label="Ruta" required></v-text-field>
                </v-col>
                <v-col cols="12" sm="12" md="12">
                  <v-text-field v-model="newItem.icono_l" label="Icono"  required></v-text-field>
                </v-col>
                <v-col cols="12" sm="12" md="12">
                  <v-textarea v-model="newItem.descripcion" label="Descripción"></v-textarea>
                </v-col>
              </v-row>
            </v-container>
          </v-card-text>
          <v-card-actions>
            <v-spacer></v-spacer>
            <v-btn color="blue darken-1" text @click="dialog = false">Close</v-btn>
            <v-btn color="blue darken-1" text @click.prevent="save">Save</v-btn>
          </v-card-actions>
        </v-card>
      </v-dialog>
    </v-row>

    <v-row justify="center">
      <v-dialog v-model="dialogDelete" max-width="350" light>
        <v-card>
          <v-card-title class="headline warning" >
            <v-icon>mdi-warning</v-icon> Eliminar Opción!
          </v-card-title>

          <v-card-text>

            <div class="my-4 subtitle-1 black--text">
              Si esta seguro de eliminar la opción del menu presione el botón sí
            </div>

          </v-card-text>

          <v-card-actions>
            <v-spacer></v-spacer>

            <v-btn outlined  color="gray" text @click="dialogDelete = false">
              NO
            </v-btn>

            <v-btn outlined  color="error" text @click="destroy">
              SÍ
            </v-btn>
          </v-card-actions>
        </v-card>
      </v-dialog>

    </v-row>

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
            // this.getDatos();
        },
        data: () => ({
            open: [1],
            search: null,
            caseSensitive: false,
            items: [],
            active: [],
            dialog: false,
            dialogDelete: false,
            newItem: {
                id: 0,
                option_id : null,
                nombre : '',
                ruta : '',
                descripcion : '',
                icono_l : 'mdi-circle',
                orden : 0
            },
            defaultItem:{
                id: 0,
                option_id : null,
                nombre : '',
                ruta : '',
                descripcion : '',
                icono_l : 'mdi-circle',
                orden : 0
            },
            itemDestroy:{

            },
            para: null
        }),

        async asyncData ({ $axios }) {


            try{
                const  res  = await $axios.$get('api/options');

                return { items: res.data }

            }catch (e) {
                return { error : e}
            }

        },
        computed: {
            filter () {
                return this.caseSensitive
                    ? (item, search, textKey) => item[textKey].indexOf(search) > -1
                    : undefined
            },
        },
        watch: {

        },
        methods: {
            async getDatos(){
                try{
                    const  res  = await this.$axios.$get('api/options');

                    this.items = res.data;

                }catch (e) {
                    this.consolaJs(e)
                }
            },
            create(padre){
                this.consolaJs('nuevo opcion:',padre)
                this.dialog = !this.dialog
                this.newItem.option_id = padre ? padre.id : null;
                this.newItem.ruta = padre ? '/'+padre.nombre.toLocaleLowerCase()+'/' : null;
                this.nombrePadre(padre);

            },
            edit(padre){
                this.consolaJs('edit opcion:',padre)

                this.dialog = !this.dialog

                this.newItem = Object.assign({}, padre);

                this.nombrePadre(padre);

            },
            confirmDestroy(item){
                this.dialogDelete = !this.dialogDelete

                this.itemDestroy = Object.assign({}, item);

            },
            async destroy(){
                this.consolaJs('destroy opcion:',this.itemDestroy)

                try {
                    const url = 'api/options/'+this.itemDestroy.id;

                    const res = await this.$axios.$delete(url);

                    this.notifySuccess('Listo!',res.message);
                    this.getDatos();
                    this.close();

                }catch (e) {
                    this.consolaJs(e.response)
                }

            },
            async save(){
                this.loading = true;

                try {

                    const data = this.newItem;

                    if(this.newItem.id === 0){

                        const url = 'api/options';

                        var res = await this.$axios.$post(url,data);

                    }else {

                        const url = 'api/options/'+this.newItem.id;

                        var res = await this.$axios.$patch(url,data);

                    }

                    this.notifySuccess('Listo!',res.message);

                    this.getDatos();
                    this.close();

                }catch (e) {
                    this.consolaJs(e.response);

                    var errors = e.response.data.errors;

                    if(typeof errors !== 'undefined'){

                        this.notifyErrorList(errors);
                    }

                    this.loading = false;
                }

            },
            close () {
                this.dialog = false;
                this.dialogDelete = false;
                this.loading = false;
                setTimeout(() => {
                    this.newItem = Object.assign({}, this.defaultItem);
                    this.itemDestroy = {};
                }, 300)
            },

            nombrePadre(item){

                if (item === null){
                    this.para= '';
                }else {

                    this.para= 'en /'+item.nombre

                }


            }

        }
    }
</script>


<style scoped>

</style>
