<template>
  <v-container class="fill-height" fluid>

    <v-row align="center" justify="center" class="mt-5" >
      <v-col cols="12" sm="8" md="4">

        <v-form @submit.prevent="login">
          <v-card class="elevation-12">

            <v-toolbar color="primary" dark flat>
              <v-toolbar-title v-text="name" class="font-weight-bold"></v-toolbar-title>
              <v-spacer />
            </v-toolbar>

            <v-card-text>

                <v-text-field label="Login"  prepend-icon="mdi-account" type="text" v-model="form.email"/>

                <v-text-field label="Password" prepend-icon="mdi-lock" type="password" v-model="form.password"/>

            </v-card-text>
            <v-card-actions>
              <v-spacer />
              <v-btn color="primary" type="submit">
                <span v-text="loading ? 'Ingresando' : 'Ingresar'"></span>   <v-icon v-show="loading">mdi-loading mdi-spin</v-icon>
              </v-btn>
            </v-card-actions>
          </v-card>
        </v-form>
      </v-col>
    </v-row>
  </v-container>
</template>

<script>
    import pkg from '../../package'

    export default {
        layout: 'clean',
        name: "login",
        data(){
            return {
                name: pkg.name.toUpperCase(),
                loading: false,
                form: {
                    email:'',
                    password:'',
                }
            }
        },
        methods: {
            async login(){

                this.loading = true

                let data = {
                    data: {
                        grant_type: "password",
                        client_id: process.env.PASSPORT_PASSWORD_GRANT_ID,
                        client_secret: process.env.PASSPORT_PASSWORD_GRANT_SECRET,
                        scope: "*",
                        username: this.form.email,
                        password: this.form.password
                    }
                };


                try {
                    let login = await this.$auth.loginWith("password_grant", data)

                    this.$router.replace("/");

                    this.notifySuccess('Listo','Ingreso al sistema.');


                }catch (e) {

                    console.log(e.response);

                    var error = e.response.data.message;

                    if(typeof error !== 'undefined'){

                        this.notifyError(error);
                    }

                    this.loading = false
                }



            }
        }


    }
</script>

<style scoped>

</style>
