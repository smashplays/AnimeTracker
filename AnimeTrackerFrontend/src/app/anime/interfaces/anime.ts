export interface Anime {
  data: {
    mal_id: number;
    url: string;
    images: {
      jpg: { image_url: string };
    };
    trailer: {
      youtube_id: string;
      embed_url: string;
      url: string;
    };
    title: string;
    synopsis: string;
    aired: {
      prop: {
        from: {
          day: number;
          month: number;
          year: number;
        };
        to: {
          day: number;
          month: number;
          year: number;
        };
      };
    };
    episodes: number;
    members: number;
    genres: [
      {
        name: string;
      }
    ];
    score: number;
  };
}
