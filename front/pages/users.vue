<template>
  <v-data-table
    :headers="headers"
    :items="users"
    sort-by="calories"
    class="elevation-1"
  >
    <template v-slot:top>
      <v-toolbar flat color="dark">
        <v-toolbar-title>Usuarios</v-toolbar-title>
        <v-divider
          class="mx-4"
          inset
          vertical
        ></v-divider>
        <v-spacer></v-spacer>



        <v-dialog v-model="dialog" max-width="500px">
          <template v-slot:activator="{ on }">
            <v-btn color="primary" light class="mb-2" v-on="on">New Item</v-btn>
          </template>
          <v-card>
            <v-card-title>
              <span class="headline">{{ formTitle }}</span>
            </v-card-title>

            <v-card-text>
              <v-container>
                <v-row>
                  <v-col cols="12" sm="6" md="4">
                    <v-text-field v-model="editedItem.name" label="Nombre"></v-text-field>
                  </v-col>
                  <v-col cols="12" sm="6" md="4">
                    <v-text-field v-model="editedItem.username" label="Username"></v-text-field>
                  </v-col>
                  <v-col cols="12" sm="6" md="4">
                    <v-text-field v-model="editedItem.email" label="Correo"></v-text-field>
                  </v-col>
                </v-row>
              </v-container>
            </v-card-text>

            <v-card-actions>
              <v-spacer></v-spacer>
              <v-btn color="blue darken-1" text @click="close">Cancel</v-btn>
              <v-btn color="blue darken-1" text @click="save">Save</v-btn>
            </v-card-actions>
          </v-card>
        </v-dialog>



      </v-toolbar>
    </template>
    <template v-slot:item.action="{ item }">
      <v-icon
        small
        class="mr-2"
        @click="editItem(item)"
      >
        mdi-pencil
      </v-icon>
      <v-icon
        small
        @click="deleteItem(item)"
      >
        mdi-delete
      </v-icon>
    </template>
    <template v-slot:no-data>
      <v-btn color="primary" @click="initialize">Reset</v-btn>
    </template>
  </v-data-table>
</template>

<script>

    export default {
        data: () => ({
            dialog: false,
            headers: [
                { text: 'Username', value: 'username',},
                { text: 'Nombre', value: 'name' },
                { text: 'Correo', value: 'email' },
                { text: 'Actions', value: 'action' },
            ],
            users: [],
            editedItem: {
                id : 0,
                name: '',
                username: '',
                email: '',
            },
            defaultItem: {
                id : 0,
                name: '',
                username: '',
                email: '',
            },
        }),

        computed: {
            formTitle () {
                return this.editedItem.id === 0 ? 'New Item' : 'Edit Item'
            },
        },

        watch: {
            dialog (val) {
                val || this.close()
            },
        },

        created () {
            this.initialize()
        },

        methods: {
            async initialize () {

                console.log('inicia');
                try{

                    const res = await this.$axios.$get('api/users');

                    this.users = res.data;
                    console.log(res.data);

                }catch (error) {

                    console.log(error)
                }
            },

            editItem (item) {
                this.editedItem = Object.assign({}, item)
                this.dialog = true
            },

            async deleteItem (item) {
                this.editedItem = Object.assign({}, item)
                const res = confirm('Esta seguro de eliminar el Usuario '+this.editedItem.name+' ?');

                if (res){
                    try {
                        const url = 'api/users/'+this.editedItem.id;

                        const res = await this.$axios.$delete(url);

                        this.initialize();
                        console.log(res.data);

                    }catch (e) {
                        console.log(e.response)
                    }
                }

                this.close();

            },

            close () {
                this.dialog = false
                setTimeout(() => {
                    this.editedItem = Object.assign({}, this.defaultItem)
                    this.editedIndex = -1
                }, 300)
            },

            async save () {

                if(this.editedItem.id === 0){

                    console.log('Neuvo usuario');
                    try {
                        const url = 'api/users';
                        const data = this.editedItem;


                        const res = await this.$axios.$post(url,data);

                        this.initialize();
                        console.log(res.data);

                    }catch (e) {
                        console.log(e.response)
                    }
                }else {

                    console.log('Editar usuario');

                    try {
                        const url = 'api/users/'+this.editedItem.id;
                        const data = this.editedItem;


                        const res = await this.$axios.$patch(url,data);

                        this.initialize();
                        console.log(res.data);

                    }catch (e) {
                        console.log(e.response)
                    }
                }


                this.close()
            }
        },
    }
</script>
