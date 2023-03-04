import { Component, OnInit } from '@angular/core';
import { ActivatedRoute, ParamMap } from '@angular/router';
import { Anime } from '../../interfaces/anime';
import { AnimeService } from '../../services/anime.service';
import { Characters } from '../../interfaces/characters';
import { DomSanitizer } from '@angular/platform-browser';
import { AnimeAdd } from '../../interfaces/anime-add';

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

  constructor(
    private route: ActivatedRoute,
    private animeService: AnimeService,
    private sanitizer: DomSanitizer
  ) {}

  ngOnInit(): void {
    this.paramMapSubscription();
  }

  paramMapSubscription(): void{
    this.route.paramMap.subscribe((params) => {
      this.getAnimeById(params);
      this.getAnimeCharacters(params);
    });
  }

  getAnimeById(params: ParamMap): void{
    this.animeService
    .getAnimeById(+params.get('id'))
    .subscribe((anime) => (this.selectedAnime = anime));
  }

  getAnimeCharacters(params: ParamMap): void{
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

  sanitizedUrl(url: string) {
    return this.sanitizer.bypassSecurityTrustResourceUrl(url);
  }

  addAnime(): void {
    this.animeAdded = !this.animeAdded;
    if(!this.animeAdded){
      this.addButton = "➕";
      this.characters = true;
      this.chapters = false;
      this.animeService.deleteAnime(3).subscribe();
    }else{
      this.addButton = "✔";
      console.log(this.selectedAnime);
      this.animeService.addAnime({
        "name" : this.selectedAnime.data.title,
        "mal_id" : this.selectedAnime.data.mal_id,
        "image" : this.selectedAnime.data.images.jpg.image_url
      }).subscribe((animeAdd) => this.animeAdd = animeAdd);
    }
  }
}
