<template>
    <div>
        <h4>Present</h4>
        <li v-for="value in present" v-bind:key="value" class="list-group-item" style="padding-top: 0.05rem;padding-bottom: 0.05rem;"><span style="font-family: monospace;"><div v-html="value"> </div></span></li>
    </div>

</template>

<script>
export default{
    name:"missingSH",
    props: ['present']
  
}
</script>












