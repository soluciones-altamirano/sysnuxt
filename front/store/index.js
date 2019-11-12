export const actions = {
  async nuxtServerInit({ commit },{ $axios,$auth }) {

    //si el user esta autenticado llena el menu de opciones
    if($auth.loggedIn){

      try{
        const  res  = await $axios.$get('api/options');

        const menu = res.data;

        // console.log('server init',menu);

        commit('menu/llenar',menu);

      }catch (e) {

        console.error(e)
      }
    }
  }
}
