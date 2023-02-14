export interface Anime {
  data: {
    url: string;
    images: {
      jpg: { image_url: string };
    };
    title: string;
    synopsis: string;
    aired: {
        prop: {
            from: {
                day: number,
                month: number,
                year: number
            },
            to: {
                day: number,
                month: number,
                year: number
            }
        }
    };
    episodes: number;
    members: number;
    genres: [
        {
            name: string
        }
    ]
  };
}