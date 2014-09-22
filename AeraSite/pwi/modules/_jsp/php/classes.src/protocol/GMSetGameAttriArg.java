/*    */ package protocol;
/*    */ 
/*    */ import com.goldhuman.Common.Marshal.MarshalException;
/*    */ import com.goldhuman.Common.Marshal.OctetsStream;
/*    */ import com.goldhuman.Common.Octets;
/*    */ import com.goldhuman.IO.Protocol.Rpc.Data;
/*    */ 
/*    */ public final class GMSetGameAttriArg extends Rpc.Data
/*    */ {
/*    */   public int gmroleid;
/*    */   public int localsid;
/*    */   public byte attribute;
/*    */   public Octets value;
/*    */ 
/*    */   public GMSetGameAttriArg()
/*    */   {
/* 17 */     this.value = new Octets();
/*    */   }
/*    */ 
/*    */   public OctetsStream marshal(OctetsStream os)
/*    */   {
/* 22 */     os.marshal(this.gmroleid);
/* 23 */     os.marshal(this.localsid);
/* 24 */     os.marshal(this.attribute);
/* 25 */     os.marshal(this.value);
/* 26 */     return os;
/*    */   }
/*    */ 
/*    */   public OctetsStream unmarshal(OctetsStream os) throws MarshalException
/*    */   {
/* 31 */     this.gmroleid = os.unmarshal_int();
/* 32 */     this.localsid = os.unmarshal_int();
/* 33 */     this.attribute = os.unmarshal_byte();
/* 34 */     os.unmarshal(this.value);
/* 35 */     return os;
/*    */   }
/*    */ 
/*    */   public Object clone()
/*    */   {
/*    */     try
/*    */     {
/* 42 */       GMSetGameAttriArg o = (GMSetGameAttriArg)super.clone();
/* 43 */       o.value = ((Octets)this.value.clone());
/* 44 */       return o;
/*    */     } catch (Exception e) {
/*    */     }
/* 47 */     return null;
/*    */   }
/*    */ }

/* Location:           D:\PW\1.4.5iweb\iweb\WEB-INF\classes\
 * Qualified Name:     protocol.GMSetGameAttriArg
 * JD-Core Version:    0.6.2
 */