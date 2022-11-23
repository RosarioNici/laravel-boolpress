<template>
    <nav>
      <ul>
          <!--li>
              <router-link to="/">Home</router-link>
              <router-link to="/about">Chi siamo</router-link>
              <router-link to="/contacts">Contatti</router-link>
          </li-->
          <li v-for="link, index in nav" :key="index">
              <router-link :to="link.path">{{ link.label }}</router-link>
          </li>
      </ul>
    </nav>
  </template>

  <script>
  export default {
      name:'NavComponent',
      props:{
          nav: Array
      }
  }
  </script>

  <style lang="scss" scoped>
      ul{
          display: flex;
          list-style-type: none;
          li{
              padding: 10px 5px;
          }
      }
  </style>
