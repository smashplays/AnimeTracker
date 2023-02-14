import { Component, OnInit } from '@angular/core';
import { ActivatedRoute, Data } from '@angular/router';
import { Location } from '@angular/common';
import { Anime } from '../../interfaces/anime';
import { AnimeService } from '../../services/anime.service';
import { Characters } from '../../interfaces/characters';

@Component({
  selector: 'app-info',
  templateUrl: './info.component.html',
  styleUrls: ['./info.component.css'],
})
export class InfoComponent implements OnInit{
  selectedAnime: Anime;
  animeCharacters: Characters;

  constructor(
    private route: ActivatedRoute,
    private animeService: AnimeService,
    private location: Location
  ) {}

  ngOnInit(): void {
    //el + delante de la variable, la convierte en numerica
    const id: number = +this.route.snapshot.paramMap.get('id');
    this.animeService
      .getAnimeById(id)
      .subscribe((anime) => (this.selectedAnime = anime));
    this.animeService
      .getAnimeCharacters(id)
      .subscribe((characters) => (this.animeCharacters = characters));
  }

  public back(): void {
    this.location.back();
  }
}
