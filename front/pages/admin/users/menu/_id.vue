<template>
  <div>
    <h1>Menu del usuario  {{titulo}}</h1>



    <v-container >
      <v-row no-gutters >
        <v-col  sm="12" >

              <v-treeview
                selectable
                open-all
                :items="options"
                selected-color="withe"
                item-key="id"
                v-model="activos"
              >

              </v-treeview>
        </v-col>
        <v-col sm12>
            <v-btn @click="$router.back()" outlined color="default">
                CANCELAR
            </v-btn>
            <v-btn @click="save" outlined color="success" >
                GUARDAR
            </v-btn>
        </v-col>
      </v-row>
    </v-container>
  </div>
</template>

<script>

    export default {
        middleware: 'auth',
        created(){
            this.consolaJs("Componente Menu del usuario creado")
            this.getDatos();
        },
        data: () => ({
            loading: false,
            user: {},
            options: [],
            activos:[]
        }),
        async asyncData ({ $axios }) {


            try{
                const  res  = await $axios.$get('api/options');

                return { options: res.data }

            }catch (e) {
                return { error : e}
            }

        },
        computed: {
            titulo () {
                return this.user.name || null ;
            }
        },
        methods: {
            async getDatos () {

                this.consolaJs("método get datos Menu del usuario");

                try{

                    const id = this.$route.params.id;

                    const res = await this.$axios.$get('api/users/'+id);


                    this.user = res.data;

                    this.activos = this.pluckArrayObjets(this.user.options,'id');


                }catch (error) {

                    console.log(error.data)
                }


            },
            async save () {

               try{

                   const data = this.activos;
                   const uri = 'api/users/menu/store/'+this.user.id;

                   const res = await this.$axios.$post(uri,data);

                   this.consolaJs(res);
                   this.notifySuccess('Listo!',res.message);

               }catch (error) {

                   this.consolaJs(error.response);
               }


            }

        }
    }
</script>


<style scoped>

</style>
