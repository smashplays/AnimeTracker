import { Component, OnInit } from '@angular/core';
import { AnimeAdd } from 'src/app/anime/interfaces/anime-add';
import { AnimeUser } from 'src/app/anime/interfaces/anime-user';
import { AnimeService } from 'src/app/anime/services/anime.service';
import { Respuesta } from '../../interfaces/user';
import { UserService } from '../../services/user.service';

@Component({
  selector: 'app-profile',
  templateUrl: './profile.component.html',
  styleUrls: ['./profile.component.css'],
})
export class ProfileComponent implements OnInit {
  userName: Respuesta;
  animes: AnimeUser;

  constructor(
    private userService: UserService,
    private animeService: AnimeService
  ) {}

  ngOnInit(): void {
    this.userService.me().subscribe((name) => {
      this.userName = name;
      console.log(this.userName);
    });
    this.animeService.getAnimesByUser(this.userName.data.id).subscribe(res => console.log(res))
  }
}
