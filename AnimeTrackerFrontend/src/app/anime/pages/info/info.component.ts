import { Component, OnInit } from '@angular/core';
import { ActivatedRoute, ParamMap } from '@angular/router';
import { Anime } from '../../interfaces/anime';
import { AnimeService } from '../../services/anime.service';
import { Characters } from '../../interfaces/characters';
import { DomSanitizer } from '@angular/platform-browser';
import { AnimeAdd } from '../../interfaces/anime-add';
import { catchError, EMPTY } from 'rxjs';
import { Respuesta } from 'src/app/user/interfaces/user';
import { UserService } from '../../../user/services/user.service';
import { B } from '@fullcalendar/core/internal-common';

@Component({
  selector: 'app-info',
  templateUrl: './info.component.html',
  styleUrls: ['./info.component.css'],
})
export class InfoComponent implements OnInit {
  selectedAnime: Anime;
  animeAdd: AnimeAdd;
  animeCharacters: Characters;
  characters: boolean = true;
  trailer: boolean = false;
  chapters: boolean = false;
  animeAdded: boolean = false;
  addButton: string = "➕";
  userInfor:Respuesta;
  charge:boolean=false;

  constructor(
    private route: ActivatedRoute,
    private animeService: AnimeService,
    private userService: UserService,
    private sanitizer: DomSanitizer
  ) {}

  ngOnInit(): void {
    this.paramMapSubscription();

    this.userService.me().subscribe(res=> {
      this.userInfor= res;
      this.charge=true;
    })
  }

  paramMapSubscription(): void {
    this.route.paramMap.subscribe((params) => {
      this.getAnimeById(params);
      this.getAnimeCharacters(params);
      this.animeService.checkAnime(+params.get('id')).subscribe((res) => {
        this.addButton = '➕';
        this.animeAdded = false;
        if (res) {
          this.addButton = '✔';
          this.animeAdded = true;
        }
        });
    });
   
  }

  getAnimeById(params: ParamMap): void {
    this.animeService
      .getAnimeById(+params.get('id'))
      .subscribe((anime) => (this.selectedAnime = anime));
  }

  getAnimeCharacters(params: ParamMap): void {
    this.animeService
      .getAnimeCharacters(+params.get('id'))
      .subscribe((characters) => (this.animeCharacters = characters));
  }

  characterBool() {
    this.characters = true;
    this.trailer = false;
    this.chapters = false;
  }

  trailerBool() {
    this.trailer = true;
    this.characters = false;
    this.chapters = false;
  }

  chaptersBool() {
    this.chapters = true;
    this.characters = false;
    this.trailer = false;
  }

  addedFalse() {
    this.addButton = '➕';
    this.animeAdded = false;
    this.characters = true;
    this.chapters = false;
    this.animeService.deleteAnime(this.selectedAnime.data.mal_id).subscribe();
  }

  addedTrue() {
    this.addButton = '✔';
    if (this.animeService.checkAnime(this.selectedAnime.data.mal_id)) {
      this.animeService
        .addAnime({
          name: this.selectedAnime.data.title,
          mal_id: this.selectedAnime.data.mal_id,
          image: this.selectedAnime.data.images.jpg.image_url,
        })
        .subscribe((animeAdd) => (this.animeAdd = animeAdd));
    }
    
    this.animeService.addAnimeUser(this.userInfor.data.id,this.selectedAnime.data.mal_id).subscribe( res=> console.log('agregado'));
    this.animeAdded = true;
  }

  sanitizedUrl(url: string) {
    return this.sanitizer.bypassSecurityTrustResourceUrl(url);
  }

  addAnime(): void {
    if (this.animeAdded) {
      this.addedFalse();
    } else {
      this.addedTrue();
    }
  }
}
