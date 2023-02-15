import { Injectable } from '@angular/core';
import { HttpClient } from '@angular/common/http';
import { Observable } from 'rxjs';
import { HttpHeaders } from '@angular/common/http';
import { Respuesta, Data } from '../interfaces/login';
import { FormControl, FormGroup } from '@angular/forms';

@Injectable({
  providedIn: 'root'
})


export class LoginService {

  private headers= new HttpHeaders()
  .set('content-type', 'application/json')
  .set('Access-Control-Allow-Origin', '*');
 
  constructor(
    private http : HttpClient
  ) { }
    
  private URL:string="http://localhost:8000/api/"

  login(data:Data):Observable<Respuesta>{

    return this.http.post<Respuesta>(this.URL+'login' 
      ,data
      ,{"headers":this.headers})
  }

  
  register(data:FormGroup):Observable<Respuesta>{

    return this.http.post<Respuesta>(this.URL+'create' 
      ,data
      ,{"headers":this.headers})
  }
}
