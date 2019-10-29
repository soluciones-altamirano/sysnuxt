<template>
  <v-container
    class="fill-height"
    fluid
  >
    <v-row
      align="center"
      justify="center" class="mt-5" >
      <v-col
        cols="12"
        sm="8"
        md="4"
      >
          <v-card class="elevation-12">
            <v-toolbar
              color="primary"
              dark
              flat
            >
              <v-toolbar-title v-text="name"></v-toolbar-title>
              <v-spacer />

            </v-toolbar>
            <v-card-text>
              <v-form >
                <v-text-field
                  label="Login"
                  name="login"
                  prepend-icon="mdi-account"
                  type="text"
                  v-model="form.email"
                />

                <v-text-field
                  id="password"
                  label="Password"
                  name="password"
                  prepend-icon="mdi-lock"
                  type="password"
                  v-model="form.password"
                />
              </v-form>
            </v-card-text>
            <v-card-actions>
              <v-spacer />
              <v-btn color="primary" @click="login">
                Ingresar   <v-icon v-show="loading">mdi-loading mdi-spin</v-icon>
              </v-btn>
            </v-card-actions>
          </v-card>
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
                name: pkg.name,
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
                        client_id: "3",
                        client_secret: "AnCcP6KLuM6lHMITCmrUA0CT2tP4MBnTAwor1KQ1",
                        scope: "*",
                        username: this.form.email,
                        password: this.form.password
                    }
                };

                console.log('login');
                console.log(data);


                try {
                    let login = await this.$auth.loginWith("password_grant", data)

                    this.$router.replace("/");

                    // this.$toast.success('Ingreso al sistema con éxito',{duration: 5000})
                }catch (e) {

                    // this.$toast.error('Algo a salido Mal',{duration: 5000});
                    console.log(e)
                }



            }
        }


    }
</script>

<style scoped>

</style>
