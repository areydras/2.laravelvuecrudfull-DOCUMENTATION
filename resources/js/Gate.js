export default class Gate{

    constructor(user){ //membuat constructor dengan parameter user dimana jika kita ingin mengakses Gate.js ini harus memberikan parameter
        this.user = user //membuat variabel user = dengan isi parameter user
    }

    isAdmin(){
        if (this.user.type == 'admin') {//jika user type =admin
            return true
        }
    }
    isDeveloper(){
        if(this.user.type == 'developer'){
            return true
        }
    }
    
}