import { Injectable } from '@angular/core';
import { HttpClient } from '@angular/common/http';
import { Observable, map, of } from 'rxjs';
import { HttpHeaders } from '@angular/common/http';
import { Respuesta, Data } from '../interfaces/login';
import { FormControl, FormGroup } from '@angular/forms';

@Injectable({
  providedIn: 'root'
})


export class LoginService {

 
  constructor(
    private http : HttpClient
  ) { }
    
  private URL:string="http://localhost:8000/api/"

  private headers= new HttpHeaders()
  .set('content-type', 'application/json')
  .set('Access-Control-Allow-Origin', '*')
  .set('Authorization', 'Bearer ' + localStorage.getItem('token'))
 

  login(data:Data):Observable<Respuesta>{

    return this.http.post<Respuesta>(this.URL+'login' 
      ,data
      ,{"headers":this.headers})
  }

  logout():Observable<Respuesta>{
    
    let headers :HttpHeaders= new HttpHeaders()
    .set('content-type', 'application/json')
    .set('Access-Control-Allow-Origin', '*')
    .set('Authorization', 'Bearer ' + localStorage.getItem('token') )
   

    return this.http.get<Respuesta>(this.URL+'logout'
    ,{"headers":headers})
    
  }

  me():Observable<Respuesta>{
    return this.http.get<Respuesta>(this.URL+'me'
    ,{"headers":this.headers})
  }

  auth():Observable<boolean> {

    if (!localStorage.getItem('token')){
      return of(false);
    }

    let headers= new HttpHeaders()
    .set('content-type', 'application/json')
    .set('Access-Control-Allow-Origin', '*')
    .set('Authorization', 'Bearer ' + localStorage.getItem('token'))

    return this.http.get<Respuesta>(this.URL+'me'
    ,{"headers":headers}).pipe(map(res=> {
     
     if (res.success){
      return true
     }
     
      return false
    
    }))
  }

  
  register(data:FormGroup):Observable<Respuesta>{

    return this.http.post<Respuesta>(this.URL+'create' 
      ,data
      ,{"headers":this.headers})
  }
}
