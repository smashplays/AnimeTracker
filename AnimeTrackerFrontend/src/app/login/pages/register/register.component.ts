import { Component, OnInit } from '@angular/core';
import { FormBuilder, FormControl, FormGroup, Validators } from '@angular/forms';
import { LoginService } from '../../services/login.service';

@Component({
  selector: 'app-register',
  templateUrl: './register.component.html',
  styleUrls: ['./register.component.css']
})
export class RegisterComponent implements OnInit {


  constructor(
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
    //Called after the constructor, initializing input properties, and the first call to ngOnChanges.
    //Add 'implements OnInit' to the class.
    
  }
    register():void{
     
      //this.userForm.valueChanges.subscribe(values=>console.log(values));
      //console.log(this.userForm.value);
       this.createService.register(this.userForm.value).subscribe();
    }


}
