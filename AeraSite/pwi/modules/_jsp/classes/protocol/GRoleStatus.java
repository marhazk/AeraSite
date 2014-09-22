/*     */ package protocol;
/*     */ 
/*     */ import com.goldhuman.Common.Marshal.MarshalException;
/*     */ import com.goldhuman.Common.Marshal.OctetsStream;
/*     */ import com.goldhuman.Common.Octets;
/*     */ import com.goldhuman.IO.Protocol.Rpc.Data;
/*     */ 
/*     */ public final class GRoleStatus extends Rpc.Data
/*     */ {
/*     */   public byte version;
/*     */   public int level;
/*     */   public int level2;
/*     */   public int exp;
/*     */   public int sp;
/*     */   public int pp;
/*     */   public int hp;
/*     */   public int mp;
/*     */   public float posx;
/*     */   public float posy;
/*     */   public float posz;
/*     */   public int worldtag;
/*     */   public int invader_state;
/*     */   public int invader_time;
/*     */   public int pariah_time;
/*     */   public int reputation;
/*     */   public Octets custom_status;
/*     */   public Octets filter_data;
/*     */   public Octets charactermode;
/*     */   public Octets instancekeylist;
/*     */   public int dbltime_expire;
/*     */   public int dbltime_mode;
/*     */   public int dbltime_begin;
/*     */   public int dbltime_used;
/*     */   public int dbltime_max;
/*     */   public int time_used;
/*     */   public Octets dbltime_data;
/*     */   public short storesize;
/*     */   public Octets petcorral;
/*     */   public Octets property;
/*     */   public Octets var_data;
/*     */   public Octets skills;
/*     */   public Octets storehousepasswd;
/*     */   public Octets waypointlist;
/*     */   public Octets coolingtime;
/*     */   public Octets npc_relation;
/*     */   public Octets multi_exp_ctrl;
/*     */   public Octets storage_task;
/*     */   public Octets faction_contrib;
/*     */   public Octets force_data;
/*     */   public byte reserved31;
/*     */   public short reserved32;
/*     */   public int reserved4;
/*     */   public int reserved5;
/*     */ 
/*     */   public GRoleStatus()
/*     */   {
/*  57 */     this.custom_status = new Octets();
/*  58 */     this.filter_data = new Octets();
/*  59 */     this.charactermode = new Octets();
/*  60 */     this.instancekeylist = new Octets();
/*  61 */     this.dbltime_data = new Octets();
/*  62 */     this.petcorral = new Octets();
/*  63 */     this.property = new Octets();
/*  64 */     this.var_data = new Octets();
/*  65 */     this.skills = new Octets();
/*  66 */     this.storehousepasswd = new Octets();
/*  67 */     this.waypointlist = new Octets();
/*  68 */     this.coolingtime = new Octets();
/*  69 */     this.npc_relation = new Octets();
/*  70 */     this.multi_exp_ctrl = new Octets();
/*  71 */     this.storage_task = new Octets();
/*  72 */     this.faction_contrib = new Octets();
/*  73 */     this.force_data = new Octets();
/*     */   }
/*     */ 
/*     */   public OctetsStream marshal(OctetsStream os)
/*     */   {
/*  78 */     os.marshal(this.version);
/*  79 */     os.marshal(this.level);
/*  80 */     os.marshal(this.level2);
/*  81 */     os.marshal(this.exp);
/*  82 */     os.marshal(this.sp);
/*  83 */     os.marshal(this.pp);
/*  84 */     os.marshal(this.hp);
/*  85 */     os.marshal(this.mp);
/*  86 */     os.marshal(this.posx);
/*  87 */     os.marshal(this.posy);
/*  88 */     os.marshal(this.posz);
/*  89 */     os.marshal(this.worldtag);
/*  90 */     os.marshal(this.invader_state);
/*  91 */     os.marshal(this.invader_time);
/*  92 */     os.marshal(this.pariah_time);
/*  93 */     os.marshal(this.reputation);
/*  94 */     os.marshal(this.custom_status);
/*  95 */     os.marshal(this.filter_data);
/*  96 */     os.marshal(this.charactermode);
/*  97 */     os.marshal(this.instancekeylist);
/*  98 */     os.marshal(this.dbltime_expire);
/*  99 */     os.marshal(this.dbltime_mode);
/* 100 */     os.marshal(this.dbltime_begin);
/* 101 */     os.marshal(this.dbltime_used);
/* 102 */     os.marshal(this.dbltime_max);
/* 103 */     os.marshal(this.time_used);
/* 104 */     os.marshal(this.dbltime_data);
/* 105 */     os.marshal(this.storesize);
/* 106 */     os.marshal(this.petcorral);
/* 107 */     os.marshal(this.property);
/* 108 */     os.marshal(this.var_data);
/* 109 */     os.marshal(this.skills);
/* 110 */     os.marshal(this.storehousepasswd);
/* 111 */     os.marshal(this.waypointlist);
/* 112 */     os.marshal(this.coolingtime);
/* 113 */     os.marshal(this.npc_relation);
/* 114 */     os.marshal(this.multi_exp_ctrl);
/* 115 */     os.marshal(this.storage_task);
/* 116 */     os.marshal(this.faction_contrib);
/* 117 */     os.marshal(this.force_data);
/* 118 */     os.marshal(this.reserved31);
/* 119 */     os.marshal(this.reserved32);
/* 120 */     os.marshal(this.reserved4);
/* 121 */     os.marshal(this.reserved5);
/* 122 */     return os;
/*     */   }
/*     */ 
/*     */   public OctetsStream unmarshal(OctetsStream os) throws MarshalException
/*     */   {
/* 127 */     this.version = os.unmarshal_byte();
/* 128 */     this.level = os.unmarshal_int();
/* 129 */     this.level2 = os.unmarshal_int();
/* 130 */     this.exp = os.unmarshal_int();
/* 131 */     this.sp = os.unmarshal_int();
/* 132 */     this.pp = os.unmarshal_int();
/* 133 */     this.hp = os.unmarshal_int();
/* 134 */     this.mp = os.unmarshal_int();
/* 135 */     this.posx = os.unmarshal_float();
/* 136 */     this.posy = os.unmarshal_float();
/* 137 */     this.posz = os.unmarshal_float();
/* 138 */     this.worldtag = os.unmarshal_int();
/* 139 */     this.invader_state = os.unmarshal_int();
/* 140 */     this.invader_time = os.unmarshal_int();
/* 141 */     this.pariah_time = os.unmarshal_int();
/* 142 */     this.reputation = os.unmarshal_int();
/* 143 */     os.unmarshal(this.custom_status);
/* 144 */     os.unmarshal(this.filter_data);
/* 145 */     os.unmarshal(this.charactermode);
/* 146 */     os.unmarshal(this.instancekeylist);
/* 147 */     this.dbltime_expire = os.unmarshal_int();
/* 148 */     this.dbltime_mode = os.unmarshal_int();
/* 149 */     this.dbltime_begin = os.unmarshal_int();
/* 150 */     this.dbltime_used = os.unmarshal_int();
/* 151 */     this.dbltime_max = os.unmarshal_int();
/* 152 */     this.time_used = os.unmarshal_int();
/* 153 */     os.unmarshal(this.dbltime_data);
/* 154 */     this.storesize = os.unmarshal_short();
/* 155 */     os.unmarshal(this.petcorral);
/* 156 */     os.unmarshal(this.property);
/* 157 */     os.unmarshal(this.var_data);
/* 158 */     os.unmarshal(this.skills);
/* 159 */     os.unmarshal(this.storehousepasswd);
/* 160 */     os.unmarshal(this.waypointlist);
/* 161 */     os.unmarshal(this.coolingtime);
/* 162 */     os.unmarshal(this.npc_relation);
/* 163 */     os.unmarshal(this.multi_exp_ctrl);
/* 164 */     os.unmarshal(this.storage_task);
/* 165 */     os.unmarshal(this.faction_contrib);
/* 166 */     os.unmarshal(this.force_data);
/* 167 */     this.reserved31 = os.unmarshal_byte();
/* 168 */     this.reserved32 = os.unmarshal_short();
/* 169 */     this.reserved4 = os.unmarshal_int();
/* 170 */     this.reserved5 = os.unmarshal_int();
/* 171 */     return os;
/*     */   }
/*     */ 
/*     */   public Object clone()
/*     */   {
/*     */     try
/*     */     {
/* 178 */       GRoleStatus o = (GRoleStatus)super.clone();
/* 179 */       o.custom_status = ((Octets)this.custom_status.clone());
/* 180 */       o.filter_data = ((Octets)this.filter_data.clone());
/* 181 */       o.charactermode = ((Octets)this.charactermode.clone());
/* 182 */       o.instancekeylist = ((Octets)this.instancekeylist.clone());
/* 183 */       o.dbltime_data = ((Octets)this.dbltime_data.clone());
/* 184 */       o.petcorral = ((Octets)this.petcorral.clone());
/* 185 */       o.property = ((Octets)this.property.clone());
/* 186 */       o.var_data = ((Octets)this.var_data.clone());
/* 187 */       o.skills = ((Octets)this.skills.clone());
/* 188 */       o.storehousepasswd = ((Octets)this.storehousepasswd.clone());
/* 189 */       o.waypointlist = ((Octets)this.waypointlist.clone());
/* 190 */       o.coolingtime = ((Octets)this.coolingtime.clone());
/* 191 */       o.npc_relation = ((Octets)this.npc_relation.clone());
/* 192 */       o.multi_exp_ctrl = ((Octets)this.multi_exp_ctrl.clone());
/* 193 */       o.storage_task = ((Octets)this.storage_task.clone());
/* 194 */       o.faction_contrib = ((Octets)this.faction_contrib.clone());
/* 195 */       o.force_data = ((Octets)this.force_data.clone());
/* 196 */       return o;
/*     */     } catch (Exception e) {
/*     */     }
/* 199 */     return null;
/*     */   }
/*     */ }

/* Location:           D:\PW\1.4.5iweb\iweb\WEB-INF\classes\
 * Qualified Name:     protocol.GRoleStatus
 * JD-Core Version:    0.6.2
 */