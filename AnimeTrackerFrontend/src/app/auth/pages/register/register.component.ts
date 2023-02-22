import { Component, OnInit } from '@angular/core';
import { FormBuilder, FormControl, FormGroup, Validators } from '@angular/forms';
import { LoginService } from '../../services/login.service';
import { Router } from '@angular/router';
import { tap } from 'rxjs';
import { Respuesta } from '../../interfaces/login';

@Component({
  selector: 'app-register',
  templateUrl: './register.component.html',
  styleUrls: ['./register.component.css']
})
export class RegisterComponent implements OnInit {


  constructor(
    private router : Router,
    private loginservice:LoginService,
    private createService : LoginService,
   
  ){}

  userForm :FormGroup  = new FormGroup ({
    name: new FormControl(null,[Validators.required]),
    email : new FormControl(null,[Validators.required,Validators.email]),
    password : new FormControl(null,[Validators.required]),
    rpassword :new FormControl(null,[Validators.required]),
    age: new FormControl(null,[Validators.required])
  });
   

  ngOnInit(): void {
  
   
    // if (this.loginservice.auth()) {
    //   this.router.navigate(['popular'])
    // }
    
  }
    register():void{
     
      
       this.createService.register(this.userForm.value).pipe(tap((res:Respuesta)=>{
        if (res.success){
          localStorage.setItem('token',res.data);
          this.router.navigate(['popular']);
        }
       } )).subscribe(
       );
    }


}
