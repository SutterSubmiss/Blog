let myID = window.localStorage.getItem('myid');
let username = ""
const $=(name)=>document.querySelector()
if(!myID){
    myID = Math.floor(Math.random()*1000000000)+"_"+(new Date()).getTime();
    window.localStorage.setItem('myid', myID);
}
let socket = io("ws://10.40.50.206:3000");
socket.on('username',()=>{
    if(username == "")
        username =prompt("Podaj imie:")
    socket.emit('sendname',myId,username)
})
socket.on('usercount',(count)=>{
 $('.usercount')
})