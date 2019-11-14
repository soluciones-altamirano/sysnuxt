<template>
  <div>
    <h1 class="mb-3">Menu del usuario  {{titulo}}</h1>


    <v-card >
      <v-card-text>
        <v-treeview
          selectable
          open-all
          :items="options"
          selected-color="withe"
          item-key="id"
          v-model="activos"
          dense
        >

        </v-treeview>
      </v-card-text>

      <v-card-actions class="px-5 py-5">
        <v-btn @click="backUrl" outlined color="default">
          CANCELAR
        </v-btn>
        <v-btn @click="save" outlined color="success" >
          GUARDAR
        </v-btn>
      </v-card-actions>
    </v-card>

  </div>
</template>

<script>

    export default {
        middleware: 'auth',
        created(){
            this.logInfo("Componente Menu del usuario creado");
        },
        data: () => ({
            loading: false,
            user: {},
            options: [],
            activos: []
        }),
        async asyncData ({ $axios,params }) {


            try{
                var id = params.id;

                const  resOp  = await $axios.$get('api/options');

                const resUs = await $axios.$get('api/users/'+id);

                console.log(id,resUs)

                return {
                    user: resUs.data,
                    activos: resUs.data.option_ids,
                    options: resOp.data
                }

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
            async save () {

               try{

                   const data = this.activos;
                   const uri = 'api/users/menu/store/'+this.user.id;

                   const res = await this.$axios.$post(uri,data);

                   this.notifySuccess('Listo!',res.message);

               }catch (error) {

                   this.logInfo(error.response);
               }


            }

        }
    }
</script>


<style scoped>

</style>
