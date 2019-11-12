export const state = () => ({
  options: [],
  currentOption: {}
})

export const mutations = {
    llenar(state,options){
      state.options = options
    },
    setCurrentOption(state,option){
      state.currentOption= option
    }
}

export const actions = {
  async load({commit}){
    try{
      const  res  = await this.$axios.$get('api/options');

      const menu = res.data;

      commit('llenar',menu);

    }catch (e) {

      console.error(e)
    }
  }
}
