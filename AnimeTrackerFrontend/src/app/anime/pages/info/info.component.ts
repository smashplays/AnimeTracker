import { Component, OnInit } from '@angular/core';
import { ActivatedRoute, Data } from '@angular/router';
import { Location } from '@angular/common';
import { Anime } from '../../interfaces/anime';
import { AnimeService } from '../../services/anime.service';
import { Characters } from '../../interfaces/characters';
import { DomSanitizer } from '@angular/platform-browser';

@Component({
  selector: 'app-info',
  templateUrl: './info.component.html',
  styleUrls: ['./info.component.css'],
})
export class InfoComponent implements OnInit{
  selectedAnime: Anime;
  animeCharacters: Characters;
  characters: boolean = true;
  trailer: boolean = false;

  constructor(
    private route: ActivatedRoute,
    private animeService: AnimeService,
    private location: Location,
    private sanitizer: DomSanitizer
  ) {}

  ngOnInit(): void {
    this.route.paramMap.subscribe(params => {
      this.animeService
      .getAnimeById(+params.get('id'))
      .subscribe((anime) => (this.selectedAnime = anime));
      this.animeService
      .getAnimeCharacters(+params.get('id'))
      .subscribe((characters) => (this.animeCharacters = characters));
    })
  }

   characterBool(){
    this.characters = true;
    this.trailer = false;
  }

  trailerBool(){
    this.trailer = true;
    this.characters = false;
  }

  sanitizedUrl(url: string){
    return this.sanitizer.bypassSecurityTrustResourceUrl(url);
  }


}
