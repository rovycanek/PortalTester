<template>
    <div>
        <h3>Present</h3>
        <div v-for="(value, name) in present">
            <div>{{name}}:{{value}}</div>
        </div>
    </div>

</template>

<script>
export default{
    name:"missingSH",
    props: ['present']
  
}
</script>












