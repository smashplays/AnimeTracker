import { Component } from '@angular/core';
import { Data } from 'src/app/anime/interfaces/anime-search';
import { AnimeService } from 'src/app/anime/services/anime.service';
import { LoginService } from '../../auth/services/login.service';
import { Router } from '@angular/router';

@Component({
  selector: 'app-nav-bar',
  templateUrl: './nav-bar.component.html'
})
export class NavBarComponent {
  input: string = '';
  showOverlay = true;
  suggestedAnimes: Data[];
  suggestedAnimesCopy: Data[];
  moreButton: boolean = false;
  hidden: boolean = true;

  constructor(
    private animeService: AnimeService,
    private loginservice: LoginService,
    private router: Router
  ) {}

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
      this.suggestedAnimes = this.suggestedAnimesCopy.slice(0, 5);
    });
  }

  more() {
    this.suggestedAnimes = this.suggestedAnimesCopy;
    this.suggestedAnimesCopy = [];
    this.moreButton = false;
  }

  animeSelect() {
    this.sugerencias('');
  }

  logout(): void {
    if (localStorage.getItem('token')) {
      this.loginservice.logout().subscribe((res) => {
        if (res.success) {
          localStorage.removeItem('token');
          this.router.navigate(['login']);
        }
      });
    } else {
      console.log('No estas logeado');
    }
  }

  toggleUser() {
    this.hidden = !this.hidden;
  }
}
