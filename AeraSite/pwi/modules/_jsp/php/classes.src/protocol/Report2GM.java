/*     */ package protocol;
/*     */ 
/*     */ import com.goldhuman.Common.Marshal.MarshalException;
/*     */ import com.goldhuman.Common.Marshal.OctetsStream;
/*     */ import com.goldhuman.Common.Octets;
/*     */ import com.goldhuman.IO.Protocol.Manager;
/*     */ import com.goldhuman.IO.Protocol.Protocol;
/*     */ import com.goldhuman.IO.Protocol.ProtocolException;
/*     */ import com.goldhuman.IO.Protocol.Session;
/*     */ import com.goldhuman.service.interfaces.Complain;
/*     */ import com.goldhuman.util.LocalDB;
/*     */ import java.io.PrintStream;
/*     */ 
/*     */ public final class Report2GM extends Protocol
/*     */ {
/*     */   public int roleid;
/*     */   public int localsid;
/*     */   public Octets rolename;
/*     */   public int zoneid;
/*     */   public Octets mapzone;
/*     */   public float posx;
/*     */   public float posy;
/*     */   public float posz;
/*     */   public Octets content;
/*     */   public int aid;
/*     */   public Octets line;
/*     */   public int com_roleid;
/*     */   public Octets com_rolename;
/*     */ 
/*     */   public Report2GM()
/*     */   {
/*  29 */     this.rolename = new Octets();
/*  30 */     this.mapzone = new Octets();
/*  31 */     this.content = new Octets();
/*  32 */     this.line = new Octets();
/*  33 */     this.com_rolename = new Octets();
/*     */   }
/*     */ 
/*     */   public OctetsStream marshal(OctetsStream os)
/*     */   {
/*  38 */     os.marshal(this.roleid);
/*  39 */     os.marshal(this.localsid);
/*  40 */     os.marshal(this.rolename);
/*  41 */     os.marshal(this.zoneid);
/*  42 */     os.marshal(this.mapzone);
/*  43 */     os.marshal(this.posx);
/*  44 */     os.marshal(this.posy);
/*  45 */     os.marshal(this.posz);
/*  46 */     os.marshal(this.content);
/*  47 */     os.marshal(this.aid);
/*  48 */     os.marshal(this.line);
/*  49 */     os.marshal(this.com_roleid);
/*  50 */     os.marshal(this.com_rolename);
/*  51 */     return os;
/*     */   }
/*     */ 
/*     */   public OctetsStream unmarshal(OctetsStream os) throws MarshalException
/*     */   {
/*  56 */     this.roleid = os.unmarshal_int();
/*  57 */     this.localsid = os.unmarshal_int();
/*  58 */     os.unmarshal(this.rolename);
/*  59 */     this.zoneid = os.unmarshal_int();
/*  60 */     os.unmarshal(this.mapzone);
/*  61 */     this.posx = os.unmarshal_float();
/*  62 */     this.posy = os.unmarshal_float();
/*  63 */     this.posz = os.unmarshal_float();
/*  64 */     os.unmarshal(this.content);
/*  65 */     this.aid = os.unmarshal_int();
/*  66 */     os.unmarshal(this.line);
/*  67 */     this.com_roleid = os.unmarshal_int();
/*  68 */     os.unmarshal(this.com_rolename);
/*  69 */     return os;
/*     */   }
/*     */ 
/*     */   public Object clone()
/*     */   {
/*     */     try
/*     */     {
/*  76 */       Report2GM o = (Report2GM)super.clone();
/*  77 */       o.rolename = ((Octets)this.rolename.clone());
/*  78 */       o.mapzone = ((Octets)this.mapzone.clone());
/*  79 */       o.content = ((Octets)this.content.clone());
/*  80 */       o.line = ((Octets)this.line.clone());
/*  81 */       o.com_rolename = ((Octets)this.com_rolename.clone());
/*  82 */       return o;
/*     */     } catch (Exception e) {
/*     */     }
/*  85 */     return null;
/*     */   }
/*     */ 
/*     */   public void Process(Manager manager, Session session) throws ProtocolException
/*     */   {
/*  90 */     Complain com = new Complain();
/*  91 */     com.roleid = this.roleid;
/*  92 */     com.zoneid = this.zoneid;
/*     */     try
/*     */     {
/*  95 */       com.rolename = this.rolename.getString();
/*  96 */       com.mapzone = this.mapzone.getString();
/*  97 */       byte[] tbytes = this.content.getBytes();
/*  98 */       com.com_type = new byte[4];
/*  99 */       com.com_type[0] = tbytes[0];
/* 100 */       com.com_type[1] = tbytes[1];
/* 101 */       com.com_type[2] = tbytes[2];
/* 102 */       com.com_type[3] = tbytes[3];
/* 103 */       com.content = new Octets(tbytes, 4, tbytes.length - 4).getString();
/* 104 */       com.aid = this.aid;
/* 105 */       com.line = this.line.getString();
/* 106 */       com.com_roleid = this.com_roleid;
/* 107 */       com.com_rolename = this.com_rolename.getString();
/* 108 */       System.out.println("protocol.Report2GM:roleid=" + com.roleid + ",zoneid=" + com.zoneid + ",aid=" + com.aid + ",line=" + com.line + ",com_roleid=" + com.com_roleid + ",com_rolename=" + com.com_rolename + ",content=" + com.content);
/*     */     } catch (Exception ex) {
/* 110 */       ex.printStackTrace();
/* 111 */     }com.x = this.posx;
/* 112 */     com.y = this.posy;
/* 113 */     com.z = this.posz;
/* 114 */     LocalDB.getInstance(1000, 10000, 7200, false).addComplain(com);
/*     */   }
/*     */ }

/* Location:           D:\PW\1.4.5iweb\iweb\WEB-INF\classes\
 * Qualified Name:     protocol.Report2GM
 * JD-Core Version:    0.6.2
 */