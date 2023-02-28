import { Component, OnInit } from '@angular/core';
import { Respuesta } from '../../interfaces/user';
import { UserService } from '../../services/user.service';

@Component({
  selector: 'app-profile',
  templateUrl: './profile.component.html',
  styleUrls: ['./profile.component.css']
})
export class ProfileComponent implements OnInit {
  userName: Respuesta

  constructor(private userService: UserService){}

  ngOnInit(): void {
    this.userService.me().subscribe((name) =>{
      this.userName = name;
      console.log(this.userName);
    })
  }
}
