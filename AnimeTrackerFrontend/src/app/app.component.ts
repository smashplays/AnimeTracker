import { Component } from '@angular/core';
import { Data } from './anime/interfaces/anime-search';
import { AnimeService } from './anime/services/anime.service';

@Component({
  selector: 'app-root',
  templateUrl: './app.component.html',
  styleUrls: ['./app.component.css'],
})
export class AppComponent {
  title = 'AnimeTrackerFrontend';

  input: string = '';
  suggestedAnimes: Data[];
  suggestedAnimesCopy: Data[];
  moreButton: boolean = false;

  constructor(private animeService: AnimeService) {}

  sugerencias(input: string): void {
    this.input = input;
    this.moreButton = false;

    if (!input.trim()) {
      this.suggestedAnimes = [];
      this.suggestedAnimesCopy = [];
      this.moreButton = false;
      return;
    }

    this.animeService.getAnimeSearch(input).subscribe((search) => {
      this.suggestedAnimesCopy = search;
      if (this.suggestedAnimesCopy.length > 5) {
        this.moreButton = true;
      }
      this.suggestedAnimes = this.suggestedAnimesCopy.splice(0, 5);
    });
  }

  more() {
    this.suggestedAnimes = this.suggestedAnimesCopy;
    this.suggestedAnimesCopy = [];
    this.moreButton = false;
  }
}
